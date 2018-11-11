<?php

namespace Helpers\Calendar;

use PHPUnit\Framework\TestCase;

/**
 * Description of DateTest
 *
 * @author ksf
 */
class DateTest extends TestCase {
    
    /**
     * @covers Helpers\Calendar\Date::getWeekdayNum()
     * @covers Helpers\Calendar\Date::__construct()
     */
    public function testGetWeekdayNum()
    {
        $d1 = new Date("2018-11-11");
        $this->assertEquals(7, $d1->getWeekdayNum());
        
        $d2 = new Date("2018-12-31");
        $this->assertEquals(1, $d2->getWeekdayNum());
        
        $d3 = new Date("2019-01-01");
        $this->assertEquals(2, $d3->getWeekdayNum());
        
        $d4 = new Date("2018-01-01");
        $this->assertEquals(1, $d4->getWeekdayNum());
    }
    
    /**
     * @covers Helpers\Calendar\Date::getPrev()
     * @covers Helpers\Calendar\Date::__construct()
     */
    public function testGetPrev() {
        $d1 = new Date("2018-11-11");
        $this->assertEquals("2018-11-10", $d1->getPrev()->format("Y-m-d"));
        $this->assertEquals("2018-11-06", $d1->getPrev(5)->format("Y-m-d"));
        
        $d2 = new Date("2019-01-01");
        $this->assertEquals("2018-12-31", $d2->getPrev()->format("Y-m-d"));
        $this->assertEquals("2018-12-25", $d2->getPrev(7)->format("Y-m-d"));
    }
    
    /**
     * @covers Helpers\Calendar\Date::getNext()
     * @covers Helpers\Calendar\Date::__construct()
     */
    public function testGetNext() {
        $d1 = new Date("2018-11-11");
        $this->assertEquals("2018-11-12", $d1->getNext()->format("Y-m-d"));
        $this->assertEquals("2018-11-16", $d1->getNext(5)->format("Y-m-d"));
        
        $d2 = new Date("2018-12-31");
        $this->assertEquals("2019-01-01", $d2->getNext()->format("Y-m-d"));
        $this->assertEquals("2019-01-07", $d2->getNext(7)->format("Y-m-d"));
    }
    
    /**
     * @covers Helpers\Calendar\Date::getAsArray()
     */
    public function testGetAsArray() {
        $expected = [ 2018, 12, 31 ];
        $d1 = new Date("2018-12-31");
        $this->assertEquals($expected, $d1->getAsArray());
    }
    
    /**
     * @covers Helpers\Calendar\Date::__toString()
     */
    public function testToString() {
        $d1 = new Date("2018-12-31");
        $this->assertEquals("2018-12-31", (string) $d1);
    }
    
    /**
     * @covers Helpers\Calendar\Date::now()
     */
    public function testNow() {
        $d1 = Date::now();
        $this->assertEquals(date("Y-m-d"), (string) $d1);
    }
    
    /**
     * @covers Helpers\Calendar\Date::isMonday()
     */
    public function testIsMonday() {
        $d1 = new Date("2018-11-05");
        $this->assertTrue($d1->isMonday());
        $d2 = new Date("2018-11-12");
        $this->assertTrue($d2->isMonday());
        $d3 = new Date("2018-11-19");
        $this->assertTrue($d3->isMonday());
        $d4 = new Date("2018-11-26");
        $this->assertTrue($d4->isMonday());
        $d5 = new Date("2018-11-27");
        $this->assertFalse($d5->isMonday());
        $d6 = new Date("2018-11-25");
        $this->assertFalse($d6->isMonday());
    }
    
    /**
     * @covers Helpers\Calendar\Date::isTuesday()
     */
    public function testIsTuesday() {
        $d1 = new Date("2018-11-06");
        $this->assertTrue($d1->isTuesday());
        $d2 = new Date("2018-11-13");
        $this->assertTrue($d2->isTuesday());        
        $d3 = new Date("2018-11-20");
        $this->assertTrue($d3->isTuesday());        
        $d4 = new Date("2018-11-27");
        $this->assertTrue($d4->isTuesday());        
        $d5 = new Date("2018-11-26");
        $this->assertFalse($d5->isTuesday());        
        $d6 = new Date("2018-11-28");
        $this->assertFalse($d6->isTuesday());        
    }
    
    /**
     * @covers Helpers\Calendar\Date::isWednesday()
     */
    public function testIsWednesday() {
        $d1 = new Date("2018-11-07");
        $this->assertTrue($d1->isWednesday());
        $d2 = new Date("2018-11-14");
        $this->assertTrue($d2->isWednesday());        
        $d3 = new Date("2018-11-21");
        $this->assertTrue($d3->isWednesday());        
        $d4 = new Date("2018-11-28");
        $this->assertTrue($d4->isWednesday());        
        $d5 = new Date("2018-11-27");
        $this->assertFalse($d5->isWednesday());        
        $d6 = new Date("2018-11-29");
        $this->assertFalse($d6->isWednesday());        
    }
    
    /**
     * @covers Helpers\Calendar\Date::isThursday()
     */
    public function testIsThursday() {
        $d0 = new Date("2018-11-01");
        $this->assertTrue($d0->isThursday());
        $d1 = new Date("2018-11-08");
        $this->assertTrue($d1->isThursday());
        $d2 = new Date("2018-11-15");
        $this->assertTrue($d2->isThursday());        
        $d3 = new Date("2018-11-22");
        $this->assertTrue($d3->isThursday());        
        $d4 = new Date("2018-11-29");
        $this->assertTrue($d4->isThursday());        
        $d5 = new Date("2018-11-28");
        $this->assertFalse($d5->isThursday());        
        $d6 = new Date("2018-11-30");
        $this->assertFalse($d6->isThursday());        
    }
    
    /**
     * @covers Helpers\Calendar\Date::isFriday()
     */
    public function testIsFriday() {
        $d0 = new Date("2018-11-02");
        $this->assertTrue($d0->isFriday());
        $d1 = new Date("2018-11-09");
        $this->assertTrue($d1->isFriday());
        $d2 = new Date("2018-11-16");
        $this->assertTrue($d2->isFriday());        
        $d3 = new Date("2018-11-23");
        $this->assertTrue($d3->isFriday());        
        $d4 = new Date("2018-11-30");
        $this->assertTrue($d4->isFriday());        
        $d5 = new Date("2018-11-29");
        $this->assertFalse($d5->isFriday());        
        $d6 = new Date("2018-11-31");
        $this->assertFalse($d6->isFriday());        
    }
    
    /**
     * @covers Helpers\Calendar\Date::isSaturday()
     */
    public function testIsSaturday() {
        $d0 = new Date("2018-11-03");
        $this->assertTrue($d0->isSaturday());
        $d1 = new Date("2018-11-10");
        $this->assertTrue($d1->isSaturday());
        $d2 = new Date("2018-11-17");
        $this->assertTrue($d2->isSaturday());        
        $d3 = new Date("2018-11-24");
        $this->assertTrue($d3->isSaturday());        
        $d4 = new Date("2018-11-23");
        $this->assertFalse($d4->isSaturday());        
        $d5 = new Date("2018-11-25");
        $this->assertFalse($d5->isSaturday());        
    }
    
    /**
     * @covers Helpers\Calendar\Date::isSunday()
     */
    public function testIsSunday() {
        $d0 = new Date("2018-11-04");
        $this->assertTrue($d0->isSunday());
        $d1 = new Date("2018-11-11");
        $this->assertTrue($d1->isSunday());
        $d2 = new Date("2018-11-18");
        $this->assertTrue($d2->isSunday());        
        $d3 = new Date("2018-11-25");
        $this->assertTrue($d3->isSunday());        
        $d4 = new Date("2018-11-24");
        $this->assertFalse($d4->isSunday());        
        $d5 = new Date("2018-11-26");
        $this->assertFalse($d5->isSunday());        
    }
}
