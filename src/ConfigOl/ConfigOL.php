<?php
declare(strict_types=1);

namespace ConfigOl;

/**
 * Classe représentant une donnée du fichier configOL.xml
 */
class ConfigOL
{
    /**
     * constructeur
     *
     * @param string $baseNom
     * @param string $baseProvider
     * @param string $baseServeur
     * @param string $baseUser
     * @param string $basePsw
     * @param string $urlPlanning
     */
    public function __construct(
        readonly public string $baseNom = '',
        readonly public string $baseProvider = '',
        readonly public string $baseServeur = '',
        readonly public string $baseUser = '',
        readonly public string $basePsw = '',
        readonly public string $urlPlanning = ''
    )
    {
    }
}
