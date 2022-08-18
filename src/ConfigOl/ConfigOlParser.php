<?php
declare(strict_types=1);

namespace ConfigOl;

use ConfigOl\Exceptions\BadConfigOl;
use ConfigOl\Exceptions\FileNotFound;
use ConfigOl\Exceptions\SchemaNotFound;

/**
 * Parser pour fichier configOL
 * Lit une structure XML
 * Retourne un tableau associatif
 *     ou partie
 */
class ConfigOlParser
{

    /**
     * chemin du fichier configOL.xml
     * @var string
     */
    protected $file;
    /**
     * @var array <ConfigOL>
     */
    protected array $schemas = [];

    /**
     * Constructeur
     * @param string $filename
     * @throws FileNotFound
     */
    public function __construct(string $filename)
    {
        if (realpath($filename) === false || !is_file(realpath($filename))) {
            throw new FileNotFound($filename);
        }
        $this->file = realpath($filename);

        $this->parse();
    }

    /**
     * parse le fichier xml et stock le résultat dans schemas
     * @return void
     */
    private function parse(): void
    {
        $strXml = file_get_contents($this->file);
        if (empty($strXml)) {
            throw new BadConfigOl($this->file);
        }
        try {
            $xml = simplexml_load_string($strXml);
            if ($xml === false) {
                throw new BadConfigOl($this->file);
            }
        } catch (\Exception $e) {
            throw new BadConfigOl($this->file);
        }
        foreach ($xml as $schema => $data) {
            if ((preg_match("/^Config(?:_(\w+))?$/i", $schema, $matches) > 0) && isset($matches[1])) {
                $this->schemas[strtoupper($matches[1])] = $this->xmlToData((array)$data);
            }
        }
    }

    /**
     * Transforme une donnée xml en objet ConfigOL
     * @param array<string,mixed> $xml
     * @return ConfigOL
     */
    private function xmlToData(array $xml): ConfigOL
    {
        if (!isset($xml['BaseServeur'], $xml['BaseUser'], $xml['BasePSW'])) {
            throw new BadConfigOl($this->file, "Information requise absente");
        }
        return new ConfigOL(
            (string)($xml['BaseNom'] ?? ""),
            (string)($xml['BaseProvider'] ?? ""),
            (string)($xml['BaseServeur'] ?? ""),
            (string)($xml['BaseUser'] ?? ""),
            (string)($xml['BasePSW'] ?? ""),
            (string)($xml['URLPLANNING'] ?? "")
        );
    }

    /**
     * Retourne l'ensemble des éléments de configOL
     * sous forme de tableau associatif
     * @return ConfigOL[]
     */
    public function getAll(): array
    {
        return $this->schemas;
    }

    /**
     * retourne les éléments de connexion d'un schéma.
     * Si ces derniers n'existe pas non plus, une exception est levée.
     * @param string $schema
     * @return ConfigOL
     * @throws SchemaNotFound
     */
    public function get(string $schema): ConfigOL
    {
        $schema = strtoupper($schema);
        if (isset($this->schemas[$schema])) {
            return $this->schemas[$schema];
        }
        throw new SchemaNotFound($schema);
    }
}
