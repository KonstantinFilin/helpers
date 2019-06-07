<?php

namespace Kfilin\Helpers\Str\Ru;

use PHPUnit\Framework\TestCase;
use Kfilin\Helpers\Str\Random;

class PluralizerTest extends TestCase {
    
    public function testRun()
    {
        $obj = new Pluralizer("книга", "книги", "книг");
        
        $this->assertEquals("книга", $obj->run(1));
        $this->assertEquals("книга", $obj->run(21));
        $this->assertEquals("книга", $obj->run(121));
        $this->assertEquals("книга", $obj->run(1121));
        $this->assertEquals("книги", $obj->run(2));
        $this->assertEquals("книги", $obj->run(3));
        $this->assertEquals("книги", $obj->run(4));
        $this->assertEquals("книги", $obj->run(24));
        $this->assertEquals("книги", $obj->run(124));
        $this->assertEquals("книг", $obj->run(5));
        $this->assertEquals("книг", $obj->run(6));
        $this->assertEquals("книг", $obj->run(7));
        $this->assertEquals("книг", $obj->run(8));
        $this->assertEquals("книг", $obj->run(9));
        $this->assertEquals("книг", $obj->run(10));
        $this->assertEquals("книг", $obj->run(11));
        $this->assertEquals("книг", $obj->run(15));
        $this->assertEquals("книг", $obj->run(19));
        $this->assertEquals("книг", $obj->run(20));
        $this->assertEquals("книг", $obj->run(30));
        $this->assertEquals("книг", $obj->run(100));
        $this->assertEquals("книг", $obj->run(1000));
        $this->assertEquals("книга", $obj->run(1001));
    }
}
