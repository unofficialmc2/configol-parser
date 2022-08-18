<?php
declare(strict_types=1);

namespace ConfigOl;

use ConfigOl\Exceptions\BadConfigOl;
use ConfigOl\Exceptions\FileNotFound;
use ConfigOl\Exceptions\SchemaNotFound;
use Test\TestCase;

/**
 * Test de ConfigOlParser
 */
class ConfigOlParserTest extends TestCase
{
    /**
     * Test de ParseNotFoundFile
     */
    public function testParseNotFoundFile(): void
    {
        $this->expectException(FileNotFound::class);
        new ConfigOlParser('./nofile.xml');
    }

    /**
     * Test de ParseEmptyFile
     */
    public function testParseEmptyFile(): void
    {
        $this->expectException(BadConfigOl::class);
        new ConfigOlParser(__DIR__ . '/../ressource/empty.xml');
    }

    /**
     * Test de ParseBadConfigOL
     */
    public function testParseBadConfigOL(): void
    {
        $this->expectException(BadConfigOl::class);
        new ConfigOlParser(__DIR__ . '/../ressource/badconfigol.xml');
    }

    /**
     * Test de ParseConfigOl
     */
    public function testParseConfigOl(): void
    {
        $parser = new ConfigOlParser(__DIR__ . '/../ressource/goodconfigol.xml');
        self::assertInstanceOf(ConfigOlParser::class, $parser);
    }

    /**
     * Test de ParsePartialConfigOl
     */
    public function testParsePartialConfigOl(): void
    {
        $parser = new ConfigOlParser(__DIR__ . '/../ressource/partialconfigol.xml');
        self::assertInstanceOf(ConfigOlParser::class, $parser);
    }

    /**
     * Test de ParsePartialConfigOlWithoutOptional
     */
    public function testParsePartialConfigOlWithoutOptional(): void
    {
        $parser = new ConfigOlParser(__DIR__ . '/../ressource/partialconfigol2.xml');
        self::assertInstanceOf(ConfigOlParser::class, $parser);
    }

    /**
     * Test de ParsePartialConfigOlWithoutRequired
     */
    public function testParsePartialConfigOlWithoutRequired(): void
    {
        $this->expectException(BadConfigOl::class);
        new ConfigOlParser(__DIR__ . '/../ressource/partialconfigol3.xml');
    }

    /**
     * Test de GetSchema
     */
    public function testGetSchema(): void
    {
        $parser = new ConfigOlParser(__DIR__ . '/../ressource/goodconfigol.xml');
        $config = $parser->get('SCHEMA');
        self::assertIsConfigOl($config, [
            "BaseNom" => "nom",
            "BaseProvider" => "provider",
            "BaseServeur" => "serveur",
            "BaseUser" => "user",
            "BasePSW" => "motdepass",
            "URLPLANNING" => "http://url"
        ]);

        $parser = new ConfigOlParser(__DIR__ . '/../ressource/partialconfigol.xml');
        $config = $parser->get('SCHEMA');
        self::assertIsConfigOl($config, [
            "BaseNom" => "",
            "BaseProvider" => "provider",
            "BaseServeur" => "serveur",
            "BaseUser" => "user",
            "BasePSW" => "motdepass",
        ]);
    }

    /**
     * Test de GetUnknownSchema
     */
    public function testGetUnknownSchema(): void
    {
        $this->expectException(SchemaNotFound::class);
        $parser = new ConfigOlParser(__DIR__ . '/../ressource/goodconfigol.xml');
        $parser->get('unknown');
    }
}
