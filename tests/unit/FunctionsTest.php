<?php

namespace WalterLuis\Tests\unit;

class FunctionsTest extends \PHPUnit\Framework\TestCase
{
    public function testChmod(): void
    {
        $pathToTheFile = __DIR__ . \DIRECTORY_SEPARATOR
            . '..' . \DIRECTORY_SEPARATOR
            . '.htaccess';
        $this->assertTrue(\WalterLuis\Utils\Functions::chmod($pathToTheFile, 0640));
    }
}
