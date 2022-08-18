<?php
declare(strict_types=1);

namespace ConfigOl;

/**
 * Classe représentant une donnée du fichier configOL.xml
 */
class ConfigOL
{

    public string $baseNom;
    public string $baseProvider;
    public string $baseServeur;
    public string $baseUser;
    public string $basePsw;
    public string $urlPlanning;

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
        string $baseNom = '',
        string $baseProvider = '',
        string $baseServeur = '',
        string $baseUser = '',
        string $basePsw = '',
        string $urlPlanning = ''
    ) {
        $this->baseNom = $baseNom;
        $this->baseProvider = $baseProvider;
        $this->baseServeur = $baseServeur;
        $this->baseUser = $baseUser;
        $this->basePsw = $basePsw;
        $this->urlPlanning = $urlPlanning;
    }
}
