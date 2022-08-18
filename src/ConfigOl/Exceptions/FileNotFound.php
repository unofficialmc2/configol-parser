<?php
declare(strict_types=1);

namespace ConfigOl\Exceptions;

/**
 * Exception en cas de fichier non trouvé
 */
class FileNotFound extends Exception
{
    /**
     * Constructeur
     *
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        parent::__construct("ConfigOL : le fichier $filename n'a pas été trouvé.");
    }
}
