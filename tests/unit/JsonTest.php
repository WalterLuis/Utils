<?php

namespace WalterLuis\Tests\unit;

class JsonTest extends \PHPUnit\Framework\TestCase
{
    public function testIsJson(): void
    {
        $this->assertTrue(
            \WalterLuis\Utils\Json::isJson('[]'),
            \sprintf(
                $this->msg,
                'isJson',
                '[]',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isJson('{}'),
            \sprintf(
                $this->msg,
                'isJson',
                '{}',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isJson('{"key": "value"}'),
            \sprintf(
                $this->msg,
                'isJson',
                '{"key": "value"}',
                'true'
            )
        );
        $this->assertFalse(
            \WalterLuis\Utils\Json::isJson(''),
            \sprintf(
                $this->msg,
                'isJson',
                '',
                'false'
            )
        );
        $this->assertFalse(
            \WalterLuis\Utils\Json::isJson('<html></html>{"key": "value"}'),
            \sprintf(
                $this->msg,
                'isJson',
                '<html></html>{"key": "value"}',
                'false'
            )
        );
    }

    public function testIsEmpty(): void
    {
        $this->assertTrue(
            \WalterLuis\Utils\Json::isEmpty('[]'),
            \sprintf(
                $this->msg,
                'isEmpty',
                '[]',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isEmpty('{}'),
            \sprintf(
                $this->msg,
                'isEmpty',
                '{}',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isEmpty('""'),
            \sprintf(
                $this->msg,
                'isEmpty',
                '""',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isEmpty(null),
            \sprintf(
                $this->msg,
                'isEmpty',
                'null',
                'true'
            )
        );
        $this->assertFalse(
            \WalterLuis\Utils\Json::isEmpty('{"key": "value"}'),
            \sprintf(
                $this->msg,
                'isEmpty',
                '{"key": "value"}',
                'false'
            )
        );
    }

    public function testIsConvertedJsonHtml(): void
    {
        $this->assertTrue(
            \WalterLuis\Utils\Json::isConvertedJsonHtml('[&quot;&quot;]'),
            \sprintf(
                $this->msg,
                'isConvertedJsonHtml',
                '[&quot;&quot;]',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isConvertedJsonHtml('{&quot;&quot;}'),
            \sprintf(
                $this->msg,
                'isConvertedJsonHtml',
                '{&quot;&quot;}',
                'true'
            )
        );
        $this->assertTrue(
            \WalterLuis\Utils\Json::isConvertedJsonHtml('[{&quot;&quot;}]'),
            \sprintf(
                $this->msg,
                'isConvertedJsonHtml',
                '[{&quot;&quot;}]',
                'true'
            )
        );
        $this->assertFalse(
            \WalterLuis\Utils\Json::isConvertedJsonHtml(''),
            \sprintf(
                $this->msg,
                'isConvertedJsonHtml',
                '',
                'false'
            )
        );
        $this->assertFalse(
            \WalterLuis\Utils\Json::isConvertedJsonHtml('{"key": "value"}'),
            \sprintf(
                $this->msg,
                'isConvertedJsonHtml',
                '{"key": "value"}',
                'false'
            )
        );
    }

    public function testDeleteComments(): void
    {
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"}'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"}',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} // Comment'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} // Comment',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */ // Comment'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */ // Comment',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */ /* Comment */'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */ /* Comment */',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} // Comment // Comment'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} // Comment // Comment',
                '{"key": "value"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} // Comment /* Comment */'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} // Comment /* Comment */',
                '{"key": "value"}'
            )
        );

        $this->assertSame(
            '{"key": "value"}{"key2": "value2"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */{"key2": "value2"}'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */{"key2": "value2"}',
                '{"key": "value"}{"key2": "value2"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}{"key2": "value2"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */{"key2": "value2"}'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */{"key2": "value2"}',
                '{"key": "value"}{"key2": "value2"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}{"key2": "value2"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */{"key2": "value2"} /* Comment */'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */{"key2": "value2"} /* Comment */',
                '{"key": "value"}{"key2": "value2"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}{"key2": "value2"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */{"key2": "value2"} // Comment'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */{"key2": "value2"} // Comment',
                '{"key": "value"}{"key2": "value2"}'
            )
        );
        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} // Comment /* Comment */{"key2": "value2"}'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} // Comment /* Comment */{"key2": "value2"}',
                '{"key": "value"}'
            )
        );

        $this->assertSame(
            '{"key": "value"}{"key2": "value2"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} /* Comment */{"key2": "value2"} /* Comment */ // Comment'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} /* Comment */{"key2": "value2"} /* Comment */ // Comment',
                '{"key": "value"}{"key2": "value2"}'
            )
        );

        $this->assertSame(
            '{"key": "value"}',
            \WalterLuis\Utils\Json::deleteComments('{"key": "value"} // Comment /* Comment */{"key2": "value2"} /* Comment */'),
            \sprintf(
                $this->msg,
                'deleteComments',
                '{"key": "value"} // Comment /* Comment */{"key2": "value2"} /* Comment */',
                '{"key": "value"}'
            )
        );
    }

    public function testEncode(): void
    {
        $this->assertSame(
            '{"key":"value"}',
            \WalterLuis\Utils\Json::encode(['key' => 'value']),
            \sprintf(
                $this->msg,
                'encode',
                '["key" => "value"]',
                '{"key":"value"}'
            )
        );
        $this->assertSame(
            '{"key":"value"}',
            \WalterLuis\Utils\Json::encode((object) ['key' => 'value']),
            \sprintf(
                $this->msg,
                'encode',
                '(object) ["key" => "value"]',
                '{"key":"value"}'
            )
        );
    }

    public function testDecode(): void
    {
        $this->assertSame(
            ['key' => 'value'],
            \WalterLuis\Utils\Json::decode('{"key":"value"}', \WalterLuis\Utils\Json::TYPE_ARRAY),
            \sprintf(
                $this->msg,
                'decode',
                '{"key":"value"}',
                '["key" => "value"]'
            )
        );
        $this->assertIsObject(
            \WalterLuis\Utils\Json::decode('{"key":"value"}', \WalterLuis\Utils\Json::TYPE_OBJECT),
            \sprintf(
                $this->msg,
                'decode',
                '{"key":"value"}',
                'true'
            )
        );
    }

    private $msg = "ERR: in the '%s' using '%s' expected '%s'" . \PHP_EOL;
}
