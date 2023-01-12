<?php
declare(strict_types=1);

namespace ConfigOl;

use Test\TestCase;

/**
 * Test de ConfigOlCryptedParser
 */
class ConfigOlCryptedParserTest extends TestCase
{
    /**
     * Test de ParseConfigOl
     */
    public function testParseConfigOl(): void
    {
        $parser = new ConfigOlCryptedParser(__DIR__ . '/../ressource/configOL_crypt.xml', 'JapprecieLesFruitsAuSirop');
        self::assertInstanceOf(ConfigOlParser::class, $parser);
    }


    /**
     * Test de ParseConfigOl
     */
    public function testParseConfigOlValid(): void
    {
        $parser = new ConfigOlCryptedParser(__DIR__ . '/../ressource/configOL_crypt.xml', 'JapprecieLesFruitsAuSirop');
        $config = $parser->get('test1');
        self::assertEquals('TotoEstBourré', $config->basePsw);
    }
}
