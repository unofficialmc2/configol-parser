<?php
declare(strict_types=1);

namespace Test;

use ConfigOl\ConfigOL;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

/**
 * Class de base pour les tests
 * @phpstan-type ConfInfo array<"BaseNom"|"BaseProvider"|"BaseServeur"|"BaseUser"|"BasePSW"|"URLPLANNING",string>
 */
class TestCase extends PhpUnitTestCase
{
    /**
     * @param mixed $actual
     * @param ConfInfo|null $expectedInfo
     * @param string $message
     * @return void
     */
    public static function assertIsConfigOl($actual, ?array $expectedInfo = null, string $message = ""): void
    {
        self::assertInstanceOf(ConfigOL::class, $actual, $message);
        if ($expectedInfo !== null) {
            if (isset($expectedInfo['BaseNom'])) {
                self::assertEquals(
                    $expectedInfo['BaseNom'],
                    $actual->baseNom,
                    $message . ", BaseNom n'est pas valide"
                );
            }
            if (isset($expectedInfo['BaseProvider'])) {
                self::assertEquals(
                    $expectedInfo['BaseProvider'],
                    $actual->baseProvider,
                    $message . ", BaseNom n'est pas valide"
                );
            }
            if (isset($expectedInfo['BaseServeur'])) {
                self::assertEquals(
                    $expectedInfo['BaseServeur'],
                    $actual->baseServeur,
                    $message . ", BaseServeur n'est pas valide"
                );
            }
            if (isset($expectedInfo['BaseUser'])) {
                self::assertEquals(
                    $expectedInfo['BaseUser'],
                    $actual->baseUser,
                    $message . ", BaseUser n'est pas valide"
                );
            }
            if (isset($expectedInfo['BasePSW'])) {
                self::assertEquals(
                    $expectedInfo['BasePSW'],
                    $actual->basePsw,
                    $message . ", BasePSW n'est pas valide"
                );
            }
            if (isset($expectedInfo['URLPLANNING'])) {
                self::assertEquals(
                    $expectedInfo['URLPLANNING'],
                    $actual->urlPlanning,
                    $message . ", URLPLANNING n'est pas valide"
                );
            }
        }
    }
}
