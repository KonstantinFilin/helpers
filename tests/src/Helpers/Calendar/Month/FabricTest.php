<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;
use Helpers\Calendar\Month;
use Helpers\Calendar\Month\Fabric;

/**
 * Description of Fabric
 *
 * @author ksf
 */
class FabricTest extends TestCase {
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 123f56
     */
    public function testCreateObjectFromPeriodException1() {
        Fabric::createFromPeriod("123f56");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 12356
     */
    public function testCreateObjectFromPeriodException2() {
        Fabric::createFromPeriod("12356");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 1234567
     */
    public function testCreateObjectFromPeriodException3() {
        Fabric::createFromPeriod("1234567");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: 88]
     */
    public function testCreateObjectFromPeriodException4() {
        Fabric::createFromPeriod("999988");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value:
     */
    public function testCreateObjectFromPeriodException5() {
        Fabric::createFromPeriod("");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Date must be in format YYYY-MM-DD, argument value: 11112233
     */
    public function testCreateObjectFromDtException1() {
        Fabric::createFromDt("11112233");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Date must be in format YYYY-MM-DD, argument value: 1112233
     */
    public function testCreateObjectFromDtException2() {
        Fabric::createFromDt("1112233");
    }
    
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: 22]
     */
    public function testCreateObjectFromDtException3() {
        Fabric::createFromDt("1111-22-33");
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromPeriod
     */
    public function testCreateObjectFromPeriod()
    {
        $period1 = "201602";
        $m1 = Fabric::createFromPeriod($period1);
        $this->assertEquals($period1, (string) $m1);

        $period2 = "201511";
        $m2 = Fabric::createFromPeriod($period2);
        $this->assertEquals($period2, (string) $m2);
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::createFromDt
     */
    public function testCreateObjectFromDt()
    {
        $dt1 = "2016-02-01";
        $m1 = Fabric::createFromDt($dt1);
        $this->assertEquals("201602", (string) $m1);

        $dt2 = "2015-12-31";
        $m2 = Fabric::createFromDt($dt2);
        $this->assertEquals("201512", (string) $m2);
    }
    
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::getPrev()
     */
    public function testGetPrev() {
        $m1 = new Month(2018, 5);
        $this->assertEquals("201804", (string) Fabric::getPrev($m1));
        $m2 = new Month(2018, 1);
        $this->assertEquals("201712", (string) Fabric::getPrev($m2));
    }
    
    /**
     * @covers Helpers\Calendar\Month\Fabric::getNext()
     */
    public function testGetNext() {
        $m1 = new Month(2018, 5);
        $this->assertEquals("201806", (string) Fabric::getNext($m1));
        $m2 = new Month(2018, 12);
        $this->assertEquals("201901", (string) Fabric::getNext($m2));
    }
}
