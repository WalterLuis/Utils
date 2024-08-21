<?php

namespace WalterLuis\Tests\unit;

// \WalterLuis\Utils\DateTime
class DateTimeTest extends \PHPUnit\Framework\TestCase
{
    public function testDiff(): void
    {
        $this->assertEquals(
            1,
            \WalterLuis\Utils\DateTime::diff('2022-01-01', '2022-01-02')
        );
    }

    public function testToISO(): void
    {
        $this->assertEquals(
            '2022-01-01T+00:00',
            \WalterLuis\Utils\DateTime::toISO('2022-01-01')
        );
    }

    public function testToISOArrayReturn(): void
    {
        $this->assertEquals(
            ['2022', '01', '01', '00:00:00'],
            \WalterLuis\Utils\DateTime::toISO('2022-01-01 00:00:00', true)
        );
    }

    public function testToISOTimeZone(): void
    {
        $this->assertEquals(
            '2022-01-01T+00:00',
            \WalterLuis\Utils\DateTime::toISO('2022-01-01', false, '+00:00')
        );
    }

    public function testToISOArrayReturnTimeZone(): void
    {
        $this->assertEquals(
            ['2022', '01', '01', '00:00:00'],
            \WalterLuis\Utils\DateTime::toISO('2022-01-01 00:00:00', true, '+00:00')
        );
    }
}
