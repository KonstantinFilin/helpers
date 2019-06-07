<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kfilin\Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;
use Kfilin\Helpers\Calendar\Month;

/**
 * Description of DtTest
 *
 * @author ksf
 */
class DtTest extends TestCase {
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Dt::getAsStr
     */
    public function testGetAsStr() {
        $m1 = new Month(2020, 5);
        $d1 = new Dt($m1);
        
        $this->assertEquals("2020-05-31", $d1->getAsStr(31));
        
        $m2 = new Month(2005, 3);
        $d2 = new Dt($m2);
        $this->assertEquals("2005-03-02", $d2->getAsStr(2));
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Dt::getAsObj
     */
    public function testGetAsObj() {
        $m1 = new Month(2020, 5);
        $d1 = new Dt($m1);
        
        $obj1 = $d1->getAsObj(31);

        $this->assertTrue(is_a($obj1, \Kfilin\Helpers\Calendar\Date::class));
        $this->assertEquals("2020-05-31", (string) $obj1);

        $m2 = new Month(2005, 3);
        $d2 = new Dt($m2);
        $obj2 = $d2->getAsObj(2);
        $this->assertTrue(is_a($obj2, \Kfilin\Helpers\Calendar\Date::class));
        $this->assertEquals("2005-03-02", (string) $obj2);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 31, argument value: 32
     */
    public function testGetFullDtException1() {
        $m1 = new Month(2020, 5);
        $d1 = new Dt($m1);
        $d1->getAsStr(32);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 31
     */
    public function testGetFullDtException2() {
        $m1 = new Month(2020, 4);
        $d1 = new Dt($m1);
        $d1->getAsStr(31);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 0
     */
    public function testGetFullDtException3() {
        $m1 = new Month(2020, 4);
        $d1 = new Dt($m1);
        $d1->getAsStr(0);
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Dt::max
     */
    public function testMax() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $d1 = new Dt($mo1);
        $this->assertEquals($y1 . "-0" . $m1 . "-31", $d1->max());

        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $d2 = new Dt($mo2);
        $this->assertEquals($y2 . "-0" . $m2 . "-31", $d2->max());

        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $d3 = new Dt($mo3);
        $this->assertEquals($y3 . "-" . $m3 . "-31", $d3->max());

        $y4 = 2018;
        $m4 = 4;
        $mo4 = new Month($y4, $m4);
        $d4 = new Dt($mo4);
        $this->assertEquals($y4 . "-0" . $m4 . "-30", $d4->max());
        
        $y5 = 2018;
        $m5 = 2;
        $mo5 = new Month($y5, $m5);
        $d5 = new Dt($mo5);
        $this->assertEquals($y5 . "-0" . $m5 . "-28", $d5->max());
        
        $y6 = 2016;
        $m6 = 2;
        $mo6 = new Month($y6, $m6);
        $d6 = new Dt($mo6);
        $this->assertEquals($y6 . "-0" . $m6 . "-29", $d6->max());
    }

    /**
     * @covers Kfilin\Helpers\Calendar\Month\Dt::min
     */
    public function testMin() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $d1 = new Dt($mo1);
        $this->assertEquals($y1 . "-0" . $m1 . "-01", $d1->min());
        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $d2 = new Dt($mo2);
        $this->assertEquals($y2 . "-0" . $m2 . "-01", $d2->min());
        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $d3 = new Dt($mo3);
        $this->assertEquals($y3 . "-" . $m3 . "-01", $d3->min());
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Dt::has()
     */
    public function testHas() {
        $m1 = new Month(2018, 5);
        $d1 = new Dt($m1);

        $this->assertTrue($d1->has("2018-05-01"));
        $this->assertTrue($d1->has("2018-05-15"));
        $this->assertFalse($d1->has("2017-05-15"));
        $this->assertFalse($d1->has("2019-05-15"));
        $this->assertTrue($d1->has("2018-05-31"));
        $this->assertFalse($d1->has("2018-06-01"));
        $this->assertFalse($d1->has("2018-04-30"));
    }
}
