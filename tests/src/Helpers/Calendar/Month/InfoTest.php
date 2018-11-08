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
class InfoTest extends TestCase
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
     * @covers Helpers\Calendar\Month\Info::getFullDt
     */
    public function testGetFullDt() {
        $m1 = new Month(2020, 5);
        $this->assertEquals("2020-05-31", $m1->getInfo()->getFullDt(31));
        
        $m2 = new Month(2005, 3);
        $this->assertEquals("2005-03-02", $m2->getInfo()->getFullDt(2));
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 31, argument value: 32
     */
    public function testGetFullDtException1() {
        $m1 = new Month(2020, 5);
        $m1->getInfo()->getFullDt(32);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 31
     */
    public function testGetFullDtException2() {
        $m1 = new Month(2020, 4);
        $m1->getInfo()->getFullDt(31);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 0
     */
    public function testGetFullDtException3() {
        $m1 = new Month(2020, 4);
        $m1->getInfo()->getFullDt(0);
    }
    
    
    /**
     * @covers Helpers\Calendar\Month\Info::getMaxDt
     */
    public function testGetMaxDt() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $this->assertEquals($y1 . "-0" . $m1 . "-31", $mo1->getInfo()->getMaxDt());
        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $this->assertEquals($y2 . "-0" . $m2 . "-31", $mo2->getInfo()->getMaxDt());
        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $this->assertEquals($y3 . "-" . $m3 . "-31", $mo3->getInfo()->getMaxDt());
        $y4 = 2018;
        $m4 = 4;
        $mo4 = new Month($y4, $m4);
        $this->assertEquals($y4 . "-0" . $m4 . "-30", $mo4->getInfo()->getMaxDt());
        $y5 = 2018;
        $m5 = 2;
        $mo5 = new Month($y5, $m5);
        $this->assertEquals($y5 . "-0" . $m5 . "-28", $mo5->getInfo()->getMaxDt());
        $y6 = 2016;
        $m6 = 2;
        $mo6 = new Month($y6, $m6);
        $this->assertEquals($y6 . "-0" . $m6 . "-29", $mo6->getInfo()->getMaxDt());
    }

    /**
     * @covers Helpers\Calendar\Month\Info::getMinDt
     */
    public function testGetMinDt() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $this->assertEquals($y1 . "-0" . $m1 . "-01", $mo1->getInfo()->getMinDt());
        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $this->assertEquals($y2 . "-0" . $m2 . "-01", $mo2->getInfo()->getMinDt());
        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $this->assertEquals($y3 . "-" . $m3 . "-01", $mo3->getInfo()->getMinDt());
    }

    
    /**
     * @covers Helpers\Calendar\Month\Info::isLeapYear
     */
    public function testIsLeapYear() {
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
    }

    /**
     * @covers Helpers\Calendar\Month\Info::isPast
     */
    public function testIsPast() {
        $m = new Month();
        $this->assertFalse($m->getInfo()->isPast());
        $this->assertTrue($m->getPrev()->getInfo()->isPast());
        $this->assertFalse($m->getNext()->getInfo()->isPast());        
    }
    
    /**
     * @covers Helpers\Calendar\Month\Info::isFuture
     */
    public function testIsFuture() {
        $m = new Month();
        $this->assertFalse($m->getInfo()->isPast());
        $this->assertFalse($m->getPrev()->getInfo()->isFuture());
        $this->assertTrue($m->getNext()->getInfo()->isFuture());
    }
    
    /**
     * @covers Helpers\Calendar\Month\Info::isCurrent
     */
    public function testIsCurrent() {
        $m = new Month();
        $this->assertTrue($m->getInfo()->isCurrent());
        $this->assertFalse($m->getInfo()->isPast());
        $this->assertFalse($m->getInfo()->isFuture());
    }
    
    /**
     * @covers Helpers\Calendar\Month\Info::hasDt()
     */
    public function testHasDt() {
        $m1 = new Month(2018, 5);
        $this->assertTrue($m1->hasDt("2018-05-01"));
        $this->assertTrue($m1->hasDt("2018-05-15"));
        $this->assertFalse($m1->hasDt("2017-05-15"));
        $this->assertFalse($m1->hasDt("2019-05-15"));
        $this->assertTrue($m1->hasDt("2018-05-31"));
        $this->assertFalse($m1->hasDt("2018-06-01"));
        $this->assertFalse($m1->hasDt("2018-04-30"));
    }
}
