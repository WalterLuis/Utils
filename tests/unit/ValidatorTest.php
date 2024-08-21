<?php

namespace WalterLuis\Tests\unit;

use WalterLuis\Utils\Validator;

class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testAlnum()
    {
        $this->runValidation('alnum');
    }

    public function testBool()
    {
        $this->runValidation('bool');
    }

    public function testDate()
    {
        $this->runValidation('date');
    }

    public function testDateTime()
    {
        $this->runValidation('dateTime');
    }

    public function testEmail()
    {
        $this->runValidation('email');
    }

    public function testInteger()
    {
        $this->runValidation('integer');
    }

    public function testNumeric()
    {
        $this->runValidation('numeric');
    }

    public function testPassword()
    {
        $this->runValidation('password');
    }

    public function testString()
    {
        $this->runValidation('string');
    }

    public function testText()
    {
        $this->runValidation('text');
    }

    public function testTime()
    {
        $this->runValidation('time');
    }

    public function testUrl()
    {
        $this->runValidation('url');
    }

    public function testUserName()
    {
        $method = 'userName';
        $this->runValidation($method);
    }

    public $methodList = [
        'alnum' => [
            'randomNumber',
            'word',
        ],
        'bool' => [
            'boolean',
        ],
        'date' => [
            'date',
            'dateTime',
        ],
        'dateTime' => [
            'date',
            'dateTime',
        ],
        'email' => [
            'email',
        ],
        'integer' => [
            'randomNumber',
        ],
        'numeric' => [
            'randomNumber',
        ],
        'password' => [
            // FIXME
            // 'password',
        ],
        'string' => [
            'date',
            'dateTime',
            'email',
            'password',
            'randomNumber',
            'text',
            'time',
            'url',
            'word',
        ],
        'text' => [
            'word',
        ],
        'time' => [
            'time',
        ],
        'url' => [
            'url',
        ],
        'userName' => [
            'randomNumber',
            'word',
            'date',
            'email',
        ],
    ];

    private $fakerMethods = [
        // 'boolean',
        'date',
        'dateTime',
        'email',
        'randomNumber',
        'password',
        'word',
        'text',
        'time',
        'url',
    ];

    private $msg = "ERR: in the '%s' using '%s' with '%s'" . \PHP_EOL;

    private function fillFakeData(string $methodName): ?array
    {
        $faker = \Faker\Factory::create();
        $fakerMethods = $this->fakerMethods;

        foreach (($this->methodList[$methodName] ?? []) as $methodFaker) {
            $data[1][$methodFaker] = 'dateTime' === $methodFaker
                ? ($faker->$methodFaker)->format('Y-m-d H:i:s')
                : $faker->$methodFaker();
            unset($fakerMethods[\array_search($methodFaker, $fakerMethods)]);
        }

        foreach ($fakerMethods as $methodFaker) {
            if ('password' === $methodFaker) {
                $data[0][$methodFaker] = $faker->password(20, 30);
            } elseif ('dateTime' === $methodFaker) {
                $data[0][$methodFaker] = $faker->dateTime()->format('Y-m-d H:i:s');
            } else {
                $data[0][$methodFaker] = $faker->$methodFaker();
            }
        }

        return $data ?? null;
    }

    private function runValidation(string $method)
    {
        $data = $this->fillFakeData($method);

        foreach (($data[1] ?? []) as $methodFaker => $value) {
            $this->assertTrue(
                Validator::$method($value),
                \sprintf($this->msg, $method, $methodFaker, $value)
            );
        }

        foreach (($data[0] ?? []) as $methodFaker => $value) {
            $this->assertFalse(
                Validator::$method($value),
                \sprintf($this->msg, $method, $methodFaker, $value)
            );
        }
    }
}
