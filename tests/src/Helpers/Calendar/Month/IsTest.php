<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;
use Helpers\Calendar\Month;

/**
 * Description of InfoTest
 *
 * @author ksf
 */
class IsTest extends TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Helpers\Calendar\Month\Info::isLeapYear
     */
    /*public function testIsLeapYear() {
        $m1 = new Month(2015, 1);
        $this->assertFalse($m1->getInfo()->isLeapYear());
        $m2 = new Month(2017, 1);
        $this->assertFalse($m2->getInfo()->isLeapYear());
        $m3 = new Month(2016, 1);
        $this->assertTrue($m3->getInfo()->isLeapYear());
        $m4 = new Month(2004, 1);
        $this->assertTrue($m4->getInfo()->isLeapYear());
        $m5 = new Month(2000, 1);
        $this->assertTrue($m5->getInfo()->isLeapYear());
        $m6 = new Month(1900, 1);
        $this->assertFalse($m6->getInfo()->isLeapYear());
        $m7 = new Month(2100, 1);
        $this->assertFalse($m7->getInfo()->isLeapYear());
        $m8 = new Month(2012, 1);
        $this->assertTrue($m8->getInfo()->isLeapYear());
    }*/

    /**
     * @covers Helpers\Calendar\Month\Is::past
     */
    public function testPast() {
        $m = new Month();
        $this->assertFalse($m->is()->past());
        $this->assertTrue(Fabric::getPrev($m)->is()->past());
        $this->assertFalse(Fabric::getNext($m)->is()->past());        
    }
    
    /**
     * @covers Helpers\Calendar\Month\Is::future
     * @covers Helpers\Calendar\Month\Is::__construct
     */
    public function testFuture() {
        $m = new Month();
        $this->assertFalse($m->is()->past());
        $this->assertFalse(Fabric::getPrev($m)->is()->future());
        $this->assertTrue(Fabric::getNext($m)->is()->future());
    }
    
    /**
     * @covers Helpers\Calendar\Month\Is::current
     * @covers Helpers\Calendar\Month\Is::__construct
     */
    public function testCurrent() {
        $m = new Month();
        $this->assertTrue($m->is()->current());
        $this->assertFalse($m->is()->past());
        $this->assertFalse($m->is()->future());
    }
    
    /**
     * @covers Helpers\Calendar\Month\Is::currentYear
     * @covers Helpers\Calendar\Month\Is::__construct
     */
    public function testCurrentYear() {
        $m1 = new Month();
        $this->assertTrue($m1->is()->currentYear());
        
        $m2 = new Month($m1->getYear() + 1, 1);
        $this->assertFalse($m2->is()->currentYear());
        
        $m3 = new Month($m1->getYear() - 1, 12);
        $this->assertFalse($m3->is()->currentYear());
    }
}
