<?php

namespace WalterLuis\Tests\unit;

class MbTest extends \PHPUnit\Framework\TestCase
{
    public function testStrlen(): void
    {
        $this->assertEquals(
            3,
            mb_strlen('abc')
        );
    }

    public function testStrpos(): void
    {
        $this->assertEquals(
            1,
            mb_strpos('abc', 'b')
        );
    }

    public function testStrtolower(): void
    {
        $this->assertEquals(
            'abc',
            mb_strtolower('ABC')
        );
    }

    public function testStrtoupper(): void
    {
        $this->assertEquals(
            'ABC',
            mb_strtoupper('abc')
        );
    }

    public function testSubstr(): void
    {
        $this->assertEquals(
            'bc',
            mb_substr('abc', 1)
        );
    }

    public function testSubstrLength(): void
    {
        $this->assertEquals(
            'b',
            mb_substr('abc', 1, 1)
        );
    }
}
