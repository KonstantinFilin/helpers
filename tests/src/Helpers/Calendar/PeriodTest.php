<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar;

use PHPUnit\Framework\TestCase;
/**
 * Description of PeriodTest
 *
 * @author ksf
 */
class PeriodTest extends TestCase 
{
    /**
     * @covers Helpers\Calendar\Period::__construct
     * @covers Helpers\Calendar\Period::getDt1()
     * @covers Helpers\Calendar\Period::getDt2()
     */
    public function testCreate()
    {
        $dt1 = new Date("2018-01-15");
        $dt2 = new Date("2018-01-27");
        
        $obj1 = new Period($dt1, $dt2);
        $this->assertEquals($dt1, $obj1->getDt1());
        $this->assertEquals($dt2, $obj1->getDt2());
        
        $obj2 = new Period($dt2, $dt1);
        $this->assertEquals($dt1, $obj2->getDt1());
        $this->assertEquals($dt2, $obj2->getDt2());
    }

    /**
     * @covers Helpers\Calendar\Period::__construct
     * @covers Helpers\Calendar\Period::isUnclosed()
     */
    public function testIsUnclosed()
    {
        $dt1 = new Date("2018-01-15");
        $dt2 = new Date("2018-01-27");
        
        $obj1 = new Period($dt1, $dt2);
        $this->assertFalse($obj1->isUnclosed());
        
        $obj2 = new Period($dt1);
        $this->assertTrue($obj2->isUnclosed());
    }
    

    /**
     * @covers Helpers\Calendar\Period::daysBetween()
     */
    public function testDaysBetween()
    {
        $dt1 = new Date("2018-10-29");
        $dt2 = new Date("2018-11-07");
        
        $this->assertEquals(9, Period::daysBetween($dt1, $dt2));
        
        $dt3 = new Date("2019-01-03");
        $dt4 = new Date("2018-12-15");
        
        $this->assertEquals(-19, Period::daysBetween($dt3, $dt4));
    }
}
