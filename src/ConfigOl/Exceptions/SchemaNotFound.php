<?php
declare(strict_types=1);

namespace ConfigOl\Exceptions;

/**
 * Exception déclanché quand le schema de connexion n'est pas trouvé dans la configuration
 */
class SchemaNotFound extends Exception
{
    /**
     * Constructeur
     *
     * @param string $schema
     */
    public function __construct($schema)
    {
        parent::__construct("ConfigOL : le schema $schema n'a pas été trouvé");
    }
}
