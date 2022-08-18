<?php
declare(strict_types=1);

namespace ConfigOl\Exceptions;

/**
 * Exception en cas de configuration manquante ou mal formatée
 */
class BadConfigOl extends Exception
{
    /**
     * Constructeur
     * @param string $filename
     * @param string $message
     */
    public function __construct(string $filename, $message = "")
    {
        parent::__construct(
            trim("ConfigOL : le fichier $filename n'est pas un configOL valide. " . $message)
        );
    }
}
