<?php
declare(strict_types=1);

namespace ConfigOl;

use ConfigOl\Exceptions\BadConfigOl;
use RuntimeException;

/**
 * Parser pour fichier configOL
 */
class ConfigOlCryptedParser extends ConfigOlParser
{
    protected string $key;

    /**
     * Constructeur
     * @param string $filename
     * @param string $key
     */
    public function __construct(string $filename, string $key)
    {
        $this->key = $key;
        parent::__construct($filename);
    }

    /**
     * Extraction des données avec cryptage possible
     * @param array<string,mixed> $xml
     * @return \ConfigOl\ConfigOL
     */
    protected function xmlToData(array $xml): ConfigOL
    {
        if (!isset($xml['BaseServeur'], $xml['BaseUser'], $xml['BasePSW'])) {
            throw new BadConfigOl($this->file, "Information requise absente");
        }
        $isCrypted = (bool)($xml['BaseCrypte'] ?? false);
        $password = (string)($xml['BasePSW'] ?? "");
        if ($isCrypted) {
            $password = $this->decode($password);
        }
        return new ConfigOL(
            (string)($xml['BaseNom'] ?? ""),
            (string)($xml['BaseProvider'] ?? ""),
            (string)($xml['BaseServeur'] ?? ""),
            (string)($xml['BaseUser'] ?? ""),
            $password,
            (string)($xml['URLPLANNING'] ?? "")
        );
    }

    /**
     * Décode le mot de passe
     * @param string $crypte16
     * @return string
     */
    protected function decode(string $crypte16): string
    {
        $cipher = "AES-256-CBC";
        $key = openssl_digest($this->getSecret(), "sha256", true);
        $crypted = hex2bin(str_replace(" ", "", $crypte16));
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($crypted, 0, $ivlen);
        $ciphertext_raw = substr($crypted, $ivlen);
        $result = openssl_decrypt(
            $ciphertext_raw,
            $cipher,
            $key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $iv
        );
        if ($result === false) {
            throw new RuntimeException("Impossible de décrypter un mot de passe du config OL");
        }
        return utf8_encode(rtrim($result, "\0"));
    }

    /**
     * Retourne la clé secrète
     * @return string
     */
    private function getSecret(): string
    {
        return $this->key;
    }
}
