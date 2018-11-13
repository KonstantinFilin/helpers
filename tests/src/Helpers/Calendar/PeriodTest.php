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
     * @covers Helpers\Calendar\Period::length()
     */
    public function testLength()
    {
        $dt1 = new Date("2018-10-29");
        $dt2 = new Date("2018-11-07");
        $obj1 = new Period($dt1, $dt2);
        
        $this->assertEquals(9, $obj1->length());
        
        $dt3 = new Date("2019-01-03");
        $dt4 = new Date("2018-12-15");
        $obj2 = new Period($dt3, $dt4);
        
        $this->assertEquals(19, $obj2->length());
        
        $dtNow = new Date();
        $dt5 = clone $dtNow;
        $dt5->sub(new \DateInterval("P3D"));
        $obj3 = new Period($dt5);
        
        $this->assertEquals(3, $obj3->length());
        
        $dt6 = clone $dtNow;
        $dt6->add(new \DateInterval("P5D"));
        $obj4 = new Period($dt6);
        $this->assertEquals(0, $obj4->length());
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
    
    /**
     * @covers Helpers\Calendar\Period::contains()
     */
    public function testContains()
    {
        $dt1 = new Date("2018-05-13");
        $dt2 = new Date("2018-07-09");
        $obj1 = new Period($dt1, $dt2);
        
        $this->assertFalse($obj1->contains(new Date("2018-05-12")));
        $this->assertTrue($obj1->contains(new Date("2018-05-13")));
        $this->assertTrue($obj1->contains(new Date("2018-06-20")));
        $this->assertTrue($obj1->contains(new Date("2018-07-09")));
        $this->assertFalse($obj1->contains(new Date("2018-07-10")));
        
        $dtNow = new Date();
        $dt3 = clone $dtNow;
        $dt3->sub(new \DateInterval("P10D"));
        
        $dtCheck = clone $dtNow;
        $dtCheck->sub(new \DateInterval("P6D"));
        
        $obj2 = new Period($dt3);
        $this->assertTrue($obj2->contains($dtCheck));
    }
    
    /**
     * @covers Helpers\Calendar\Period::contains()
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Cannot check future date \d{4}-\d{2}-\d{2} for unclosed period$/
     */
    public function testContainsException()
    {
        $dtNow = new Date();
        $dt3 = clone $dtNow;
        $dt3->sub(new \DateInterval("P10D"));
        
        $dtCheck = clone $dtNow;
        $dtCheck->add(new \DateInterval("P6D"));
        
        $obj2 = new Period($dt3);
        $this->assertTrue($obj2->contains($dtCheck));   
    }
}
