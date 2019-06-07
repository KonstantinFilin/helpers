<?php

namespace Helpers\Str;

use PHPUnit\Framework\TestCase;
use Kfilin\Helpers\Str\Random;

class StrRandomTest extends TestCase
{

    /**
     * @covers Kfilin\Helpers\Str\Random::createNum
     */
    public function testCreateRandomNum() {
        $len = 7;
        $value = Random::createNum($len);
        $this->assertEquals($len, strlen($value));
        $this->assertRegExp("/^[\d]{" . $len . "}$/", $value);
    }

    /**
     * @covers Kfilin\Helpers\Str\Random::create
     */
    public function testCreateRandom() {
        $len = 7;
        $value = Random::create($len);
        $this->assertEquals($len, strlen($value));
        $this->assertRegExp("/^[\w\d_]{" . $len . "}$/", $value);
    }
}
