<?php

namespace Kfilin\Helpers\Calendar;

use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase {
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
     * @covers Kfilin\Helpers\Calendar\Month::__construct
     * @covers Kfilin\Helpers\Calendar\Month::__toString
     * @covers Kfilin\Helpers\Calendar\Month::getYear
     * @covers Kfilin\Helpers\Calendar\Month::getMonthNum
     * @covers Kfilin\Helpers\Calendar\Month::getMonthNumStr
     */
    public function testCreateObject()
    {
        $m1 = new Month();
        $this->assertEquals(date("Y") . "" . date("m"), (string) $m1);
        
        $m2 = new Month(2018, 1);
        $this->assertEquals("201801", (string) $m2);
        $this->assertEquals(2018, $m2->getYear());
        $this->assertEquals(1, $m2->getMonthNum());
        $this->assertEquals("01", $m2->getMonthNumStr());
        
        $m3 = new Month(2018, "1");
        $this->assertEquals("201801", (string) $m3);
        $this->assertEquals(1, $m3->getMonthNum());
        $this->assertEquals("01", $m3->getMonthNumStr());
        
        $m4 = new Month(2018, 12);
        $this->assertEquals("201812", (string) $m4);
        $this->assertEquals(12, $m4->getMonthNum());
        $this->assertEquals("12", $m4->getMonthNumStr());

        $m5 = new Month("2018", "12");
        $this->assertEquals("201812", (string) $m5);
        $this->assertEquals(12, $m5->getMonthNum());
        $this->assertEquals("12", $m5->getMonthNumStr());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: 13]
     */
    public function testCreateObjectException1()
    {
        new Month(2020, 13);
        $this->expectException(InvalidArgumentException::class);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: -1]
     */
    public function testCreateObjectException2()
    {
        new Month(2020, -1);
        $this->expectException(InvalidArgumentException::class);
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month::__toString
     */
    public function testToString()
    {
        $m1 = new Month();
        $this->assertEquals(date("Ym"), (string) $m1);

        $m2 = new Month(2019, 1);
        $this->assertEquals("201901", (string) $m2);

        $m3 = new Month(2019, 12);
        $this->assertEquals("201912", (string) $m3);
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month::is
     */
    public function testIs()
    {
        $m = new Month();
        $this->assertTrue(is_a($m->is(), \Kfilin\Helpers\Calendar\Month\Is::class));
    }
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month::dt
     */
    public function testDt()
    {
        $m = new Month();
        $this->assertTrue(is_a($m->dt(), \Kfilin\Helpers\Calendar\Month\Dt::class));
    }

    /*public function testIsWeekday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isWeekday(5, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m1->isWeekday(12, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m1->isWeekday(19, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m1->isWeekday(11, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m1->isWeekday(13, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m1->isWeekday(18, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m1->isWeekday(20, Month::WEEKDAY_MONDAY));
        
        $m2 = new Month(2018, 5);
        $this->assertTrue($m2->isWeekday(7, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m2->isWeekday(14, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m2->isWeekday(21, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m2->isWeekday(28, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m2->isWeekday(13, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m2->isWeekday(15, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m2->isWeekday(30, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m2->isWeekday(1, Month::WEEKDAY_MONDAY));
        
        $m3 = new Month(2019, 1);
        $this->assertTrue($m3->isWeekday(7, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m3->isWeekday(14, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m3->isWeekday(21, Month::WEEKDAY_MONDAY));
        $this->assertTrue($m3->isWeekday(28, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m3->isWeekday(13, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m3->isWeekday(15, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m3->isWeekday(30, Month::WEEKDAY_MONDAY));
        $this->assertFalse($m3->isWeekday(1, Month::WEEKDAY_MONDAY));
    }    

    public function getWeekdayNameProvider() {
        return [
            [ 5, "Monday" ],
            [ 12, "Monday" ],
            [ 19, "Monday" ],
            [ 26, "Monday" ],
            [ 6, "Tuesday" ],
            [ 13, "Tuesday" ],
            [ 20, "Tuesday" ],
            [ 27, "Tuesday" ],
            [ 7, "Wednesday" ],
            [ 14, "Wednesday" ],
            [ 21, "Wednesday" ],
            [ 28, "Wednesday" ],
            [ 1, "Thursday" ],
            [ 8, "Thursday" ],
            [ 15, "Thursday" ],
            [ 22, "Thursday" ],
            [ 29, "Thursday" ],
            [ 2, "Friday" ],
            [ 9, "Friday" ],
            [ 16, "Friday" ],
            [ 23, "Friday" ],
            [ 30, "Friday" ],
            [ 3, "Saturday" ],
            [ 10, "Saturday" ],
            [ 17, "Saturday" ],
            [ 24, "Saturday" ],
            [ 4, "Sunday" ],
            [ 11, "Sunday" ],
            [ 18, "Sunday" ],
            [ 25, "Sunday" ]
        ];
    }*/

    /**
     * @covers Kfilin\Helpers\Calendar\Month::getWeekdayName
     * @dataProvider getWeekdayNameProvider
     */
    /*public function testGetWeekdayName($dayNum, $expected) 
    {
        $m1 = new Month(2018, 11);
        $this->assertEquals($expected, $m1->getWeekdayName($dayNum));
    }    
    
    public function getWeekdayNameProviderShort() {
        return [
            [ 5, "Mo" ],
            [ 12, "Mo" ],
            [ 19, "Mo" ],
            [ 26, "Mo" ],
            [ 6, "Tu" ],
            [ 13, "Tu" ],
            [ 20, "Tu" ],
            [ 27, "Tu" ],
            [ 7, "We" ],
            [ 14, "We" ],
            [ 21, "We" ],
            [ 28, "We" ],
            [ 1, "Th" ],
            [ 8, "Th" ],
            [ 15, "Th" ],
            [ 22, "Th" ],
            [ 29, "Th" ],
            [ 2, "Fr" ],
            [ 9, "Fr" ],
            [ 16, "Fr" ],
            [ 23, "Fr" ],
            [ 30, "Fr" ],
            [ 3, "Sa" ],
            [ 10, "Sa" ],
            [ 17, "Sa" ],
            [ 24, "Sa" ],
            [ 4, "Su" ],
            [ 11, "Su" ],
            [ 18, "Su" ],
            [ 25, "Su" ]
        ];
    }*/
        
    /**
     * @covers Kfilin\Helpers\Calendar\Month::getWeekdayNameShort
     * @dataProvider getWeekdayNameProviderShort
     */
    /*public function testGetWeekdayNameShort($dayNum, $expected) 
    {
        $m1 = new Month(2018, 11);
        $this->assertEquals($expected, $m1->getWeekdayNameShort($dayNum));
    } */   

        
    /**
     * @covers Kfilin\Helpers\Calendar\Month::getWeekdayNum
     */
    /*public function testGetWeekdayNum() 
    {
        $m1 = new Month(2018, 11);
        $expected20181101 = 4;
        $this->assertEquals($expected20181101, $m1->getWeekdayNum(1));
        $expected20181110 = 6;
        $this->assertEquals($expected20181110, $m1->getWeekdayNum(10));
        $expected20181115 = 4;
        $this->assertEquals($expected20181115, $m1->getWeekdayNum(15));
        $expected20181120 = 2;
        $this->assertEquals($expected20181120, $m1->getWeekdayNum(20));
        $expected20181125 = 7;
        $this->assertEquals($expected20181125, $m1->getWeekdayNum(25));
        $expected20181130 = 5;
        $this->assertEquals($expected20181130, $m1->getWeekdayNum(30));
    }*/
        
    /**
     * @covers Kfilin\Helpers\Calendar\Month::getWeekdayNumList
     */
    /*public function testGetWeekdayNumList() {
        $expected = [
            1 => 4,
            2 => 5,
            3 => 6,
            4 => 7,
            5 => 1,
            6 => 2,
            7 => 3,
            8 => 4,
            9 => 5,
            10 => 6,
            11 => 7,
            12 => 1,
            13 => 2,
            14 => 3,
            15 => 4,
            16 => 5,
            17 => 6,
            18 => 7,
            19 => 1,
            20 => 2,
            21 => 3,
            22 => 4,
            23 => 5,
            24 => 6,
            25 => 7,
            26 => 1,
            27 => 2,
            28 => 3,
            29 => 4,
            30 => 5
        ];
        
        $m1 = new Month(2018, 11);
        $this->assertEquals($expected, $m1->getWeekdayNumList());
    }*/
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month::getName
     */
    /*public function testGetName() {
        $m1 = new Month(2018, 1);
        $m2 = new Month(2018, 2);
        $m3 = new Month(2018, 3);
        $m4 = new Month(2018, 4);
        $m5 = new Month(2018, 5);
        $m6 = new Month(2018, 6);
        $m7 = new Month(2018, 7);
        $m8 = new Month(2018, 8);
        $m9 = new Month(2018, 9);
        $m10 = new Month(2018, 10);
        $m11 = new Month(2018, 11);
        $m12 = new Month(2018, 12);
        
        $this->assertEquals("January 2018", $m1->getName());
        $this->assertEquals("February 2018", $m2->getName());
        $this->assertEquals("March 2018", $m3->getName());
        $this->assertEquals("April 2018", $m4->getName());
        $this->assertEquals("May 2018", $m5->getName());
        $this->assertEquals("June 2018", $m6->getName());
        $this->assertEquals("July 2018", $m7->getName());
        $this->assertEquals("August 2018", $m8->getName());
        $this->assertEquals("September 2018", $m9->getName());
        $this->assertEquals("October 2018", $m10->getName());
        $this->assertEquals("November 2018", $m11->getName());
        $this->assertEquals("December 2018", $m12->getName());
    }*/
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month::getNameShort()
     */
    /*public function testGetNameShort() {
        $m1 = new Month(2018, 1);
        $m2 = new Month(2018, 2);
        $m3 = new Month(2018, 3);
        $m4 = new Month(2018, 4);
        $m5 = new Month(2018, 5);
        $m6 = new Month(2018, 6);
        $m7 = new Month(2018, 7);
        $m8 = new Month(2018, 8);
        $m9 = new Month(2018, 9);
        $m10 = new Month(2018, 10);
        $m11 = new Month(2018, 11);
        $m12 = new Month(2018, 12);
        
        $this->assertEquals("Jan 2018", $m1->getNameShort());
        $this->assertEquals("Feb 2018", $m2->getNameShort());
        $this->assertEquals("Mar 2018", $m3->getNameShort());
        $this->assertEquals("Apr 2018", $m4->getNameShort());
        $this->assertEquals("May 2018", $m5->getNameShort());
        $this->assertEquals("Jun 2018", $m6->getNameShort());
        $this->assertEquals("Jul 2018", $m7->getNameShort());
        $this->assertEquals("Aug 2018", $m8->getNameShort());
        $this->assertEquals("Sep 2018", $m9->getNameShort());
        $this->assertEquals("Oct 2018", $m10->getNameShort());
        $this->assertEquals("Nov 2018", $m11->getNameShort());
        $this->assertEquals("Dec 2018", $m12->getNameShort());
    }*/
}
