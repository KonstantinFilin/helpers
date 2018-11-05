<?php

namespace Helpers\Calendar;

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
     * @covers Helpers\Calendar\Month::__construct
     * @covers Helpers\Calendar\Month::__toString
     */
    public function testCreateObject()
    {
        $m1 = new Month();
        $this->assertEquals(date("Y") . "" . date("m"), (string) $m1);
        
        $m2 = new Month(2018, 1);
        $this->assertEquals("201801", (string) $m2);
        
        $m3 = new Month(2018, 12);
        $this->assertEquals("201812", (string) $m3);
        
        $m4 = new Month("2018", "12");
        $this->assertEquals("201812", (string) $m4);
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
     * @covers Helpers\Calendar\Month::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 123f56
     */
    public function testCreateObjectFromPeriodException1() {
        Month::createFromPeriod("123f56");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 12356
     */
    public function testCreateObjectFromPeriodException2() {
        Month::createFromPeriod("12356");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value: 1234567
     */
    public function testCreateObjectFromPeriodException3() {
        Month::createFromPeriod("1234567");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: 88]
     */
    public function testCreateObjectFromPeriodException4() {
        Month::createFromPeriod("999988");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromPeriod
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Period must be 6 digits, argument value:
     */
    public function testCreateObjectFromPeriodException5() {
        Month::createFromPeriod("");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Date must be in format YYYY-MM-DD, argument value: 11112233
     */
    public function testCreateObjectFromDtException1() {
        Month::createFromDt("11112233");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Date must be in format YYYY-MM-DD, argument value: 1112233
     */
    public function testCreateObjectFromDtException2() {
        Month::createFromDt("1112233");
    }
    
    
    /**
     * @covers Helpers\Calendar\Month::createFromDt
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Month must be between 1 and 12 [argument value: 22]
     */
    public function testCreateObjectFromDtException3() {
        Month::createFromDt("1111-22-33");
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromPeriod
     */
    public function testCreateObjectFromPeriod()
    {
        $period1 = "201602";
        $m1 = Month::createFromPeriod($period1);
        $this->assertEquals($period1, $m1->getYear() . $m1->getMonth());

        $period2 = "201511";
        $m2 = Month::createFromPeriod($period2);
        $this->assertEquals($period2, $m2->getYear() . $m2->getMonth());
    }
    
    /**
     * @covers Helpers\Calendar\Month::createFromDt
     * @covers Helpers\Calendar\Month::getYear
     * @covers Helpers\Calendar\Month::getMonth
     */
    public function testCreateObjectFromDt()
    {
        $dt1 = "2016-02-01";
        $m1 = Month::createFromDt($dt1);
        $this->assertEquals("201602", $m1->getYear() . $m1->getMonth());

        $dt2 = "2015-12-31";
        $m2 = Month::createFromDt($dt2);
        $this->assertEquals("201512", $m2->getYear() . $m2->getMonth());
    }
    
    /**
     * @covers Helpers\Calendar\Month::getFullDt
     */
    public function testGetFullDt() {
        $m1 = new Month(2020, 5);
        $this->assertEquals("2020-05-31", $m1->getFullDt(31));
        
        $m2 = new Month(2005, 3);
        $this->assertEquals("2005-03-02", $m2->getFullDt(2));
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 31, argument value: 32
     */
    public function testGetFullDtException1() {
        $m1 = new Month(2020, 5);
        $m1->getFullDt(32);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 31
     */
    public function testGetFullDtException2() {
        $m1 = new Month(2020, 4);
        $m1->getFullDt(31);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Day num must be between 1 and 30, argument value: 0
     */
    public function testGetFullDtException3() {
        $m1 = new Month(2020, 4);
        $m1->getFullDt(0);
    }
    
    /**
     * @covers Helpers\Calendar\Month::isMonday
     */
    public function testIsMonday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isMonday(5));
        $this->assertTrue($m1->isMonday(12));
        $this->assertTrue($m1->isMonday(19));
        $this->assertFalse($m1->isMonday(11));
        $this->assertFalse($m1->isMonday(13));
        $this->assertFalse($m1->isMonday(18));
        $this->assertFalse($m1->isMonday(20));
        
        $m2 = new Month(2018, 5);
        $this->assertTrue($m2->isMonday(7));
        $this->assertTrue($m2->isMonday(14));
        $this->assertTrue($m2->isMonday(21));
        $this->assertTrue($m2->isMonday(28));
        $this->assertFalse($m2->isMonday(13));
        $this->assertFalse($m2->isMonday(15));
        $this->assertFalse($m2->isMonday(30));
        $this->assertFalse($m2->isMonday(1));
        
        $m3 = new Month(2019, 1);
        $this->assertTrue($m3->isMonday(7));
        $this->assertTrue($m3->isMonday(14));
        $this->assertTrue($m3->isMonday(21));
        $this->assertTrue($m3->isMonday(28));
        $this->assertFalse($m3->isMonday(13));
        $this->assertFalse($m3->isMonday(15));
        $this->assertFalse($m3->isMonday(30));
        $this->assertFalse($m3->isMonday(1));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isTuesday
     */
    public function testIsTuesday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isTuesday(6));
        $this->assertTrue($m1->isTuesday(13));
        $this->assertTrue($m1->isTuesday(20));
        $this->assertTrue($m1->isTuesday(27));
        $this->assertFalse($m1->isTuesday(19));
        $this->assertFalse($m1->isTuesday(21));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isWednesday
     */
    public function testIsWednesday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isWednesday(7));
        $this->assertTrue($m1->isWednesday(14));
        $this->assertTrue($m1->isWednesday(21));
        $this->assertTrue($m1->isWednesday(28));
        $this->assertFalse($m1->isWednesday(20));
        $this->assertFalse($m1->isWednesday(22));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isThursday
     */
    public function testIsThursday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isThursday(1));
        $this->assertTrue($m1->isThursday(8));
        $this->assertTrue($m1->isThursday(15));
        $this->assertTrue($m1->isThursday(22));
        $this->assertTrue($m1->isThursday(29));
        $this->assertFalse($m1->isThursday(21));
        $this->assertFalse($m1->isThursday(23));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isFriday
     */
    public function testIsFriday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isFriday(2));
        $this->assertTrue($m1->isFriday(9));
        $this->assertTrue($m1->isFriday(16));
        $this->assertTrue($m1->isFriday(23));
        $this->assertTrue($m1->isFriday(30));
        $this->assertFalse($m1->isFriday(22));
        $this->assertFalse($m1->isFriday(24));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isSaturday
     */
    public function testIsSaturday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isSaturday(3));
        $this->assertTrue($m1->isSaturday(10));
        $this->assertTrue($m1->isSaturday(17));
        $this->assertTrue($m1->isSaturday(24));
        $this->assertFalse($m1->isSaturday(23));
        $this->assertFalse($m1->isSaturday(25));
    }    
    
    /**
     * @covers Helpers\Calendar\Month::isSunday
     */
    public function testIsSunday() 
    {
        $m1 = new Month(2018, 11);
        $this->assertTrue($m1->isSunday(4));
        $this->assertTrue($m1->isSunday(11));
        $this->assertTrue($m1->isSunday(18));
        $this->assertTrue($m1->isSunday(25));
        $this->assertFalse($m1->isSunday(24));
        $this->assertFalse($m1->isSunday(26));
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
    }
    
    /**
     * @covers Helpers\Calendar\Month::getWeekdayName
     * @dataProvider getWeekdayNameProvider
     */
    public function testGetWeekdayName($dayNum, $expected) 
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
    }
        
    /**
     * @covers Helpers\Calendar\Month::getWeekdayNameShort
     * @dataProvider getWeekdayNameProviderShort
     */
    public function testGetWeekdayNameShort($dayNum, $expected) 
    {
        $m1 = new Month(2018, 11);
        $this->assertEquals($expected, $m1->getWeekdayNameShort($dayNum));
    }    
        
    /**
     * @covers Helpers\Calendar\Month::getWeekdayNames
     */
    public function testGetWeekdayNames() 
    {
        $m1 = new Month();
        $expected = [
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday",
        ];
        $this->assertEquals($expected, $m1->getWeekdayNames());
    }    
        
    /**
     * @covers Helpers\Calendar\Month::getWeekdayNamesShort
     */
    public function testGetWeekdayNamesShort() 
    {
        $m1 = new Month();
        $expected = [
            1 => "Mo",
            2 => "Tu",
            3 => "We",
            4 => "Th",
            5 => "Fr",
            6 => "Sa",
            7 => "Su",
        ];
        $this->assertEquals($expected, $m1->getWeekdayNamesShort());
    }    
        
    /**
     * @covers Helpers\Calendar\Month::getWeekdayNum
     */
    public function testGetWeekdayNum() 
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
    }    
        
    /**
     * @covers Helpers\Calendar\Month::getMonthNames
     */
    public function testGetMonthNames() 
    {
        $m1 = new Month();
        $expected = [
            1 => "January",
            2 => "February",
            3 => "March",
            4 => "April",
            5 => "May",
            6 => "June",
            7 => "July",
            8 => "August",
            9 => "September",
            10 => "October",
            11 => "November",
            12 => "December",
        ];
        $this->assertEquals($expected, $m1->getMonthNames());
    }    
        
    /**
     * @covers Helpers\Calendar\Month::getWeekdayNumList
     */
    public function testGetWeekdayNumList() {
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
    }
    
    /**
     * @covers Helpers\Calendar\Month::getMinDt
     */
    public function testGetMinDt() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $this->assertEquals($y1 . "-0" . $m1 . "-01", $mo1->getMinDt());
        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $this->assertEquals($y2 . "-0" . $m2 . "-01", $mo2->getMinDt());
        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $this->assertEquals($y3 . "-" . $m3 . "-01", $mo3->getMinDt());
    }
    
    /**
     * @covers Helpers\Calendar\Month::getMaxDt
     */
    public function testGetMaxDt() {
        $y1 = 2018;
        $m1 = 1;
        $mo1 = new Month($y1, $m1);
        $this->assertEquals($y1 . "-0" . $m1 . "-31", $mo1->getMaxDt());
        $y2 = 2018;
        $m2 = 5;
        $mo2 = new Month($y2, $m2);
        $this->assertEquals($y2 . "-0" . $m2 . "-31", $mo2->getMaxDt());
        $y3 = 2018;
        $m3 = 12;
        $mo3 = new Month($y3, $m3);
        $this->assertEquals($y3 . "-" . $m3 . "-31", $mo3->getMaxDt());
        $y4 = 2018;
        $m4 = 4;
        $mo4 = new Month($y4, $m4);
        $this->assertEquals($y4 . "-0" . $m4 . "-30", $mo4->getMaxDt());
        $y5 = 2018;
        $m5 = 2;
        $mo5 = new Month($y5, $m5);
        $this->assertEquals($y5 . "-0" . $m5 . "-28", $mo5->getMaxDt());
        $y6 = 2016;
        $m6 = 2;
        $mo6 = new Month($y6, $m6);
        $this->assertEquals($y6 . "-0" . $m6 . "-29", $mo6->getMaxDt());
    }
    
    /**
     * @covers Helpers\Calendar\Month::isLeapYear
     */
    public function testIsLeapYear() {
        $m1 = new Month(2015, 1);
        $this->assertFalse($m1->isLeapYear());
        $m2 = new Month(2017, 1);
        $this->assertFalse($m2->isLeapYear());
        $m3 = new Month(2016, 1);
        $this->assertTrue($m3->isLeapYear());
        $m4 = new Month(2004, 1);
        $this->assertTrue($m4->isLeapYear());
        $m5 = new Month(2000, 1);
        $this->assertTrue($m5->isLeapYear());
        $m6 = new Month(1900, 1);
        $this->assertFalse($m6->isLeapYear());
        $m7 = new Month(2100, 1);
        $this->assertFalse($m7->isLeapYear());
        $m8 = new Month(2012, 1);
        $this->assertTrue($m8->isLeapYear());
    }
    
    /**
     * @covers Helpers\Calendar\Month::isPast
     */
    public function testIsPast() {
        $m = new Month();
        $this->assertFalse($m->isPast());
        $this->assertTrue($m->getPrev()->isPast());
        $this->assertFalse($m->getNext()->isPast());        
    }
    
    /**
     * @covers Helpers\Calendar\Month::isFuture
     */
    public function testIsFuture() {
        $m = new Month();
        $this->assertFalse($m->isPast());
        $this->assertFalse($m->getPrev()->isFuture());
        $this->assertTrue($m->getNext()->isFuture());
    }
    
    /**
     * @covers Helpers\Calendar\Month::isCurrent
     */
    public function testIsCurrent() {
        $m = new Month();
        $this->assertTrue($m->isCurrent());
        $this->assertFalse($m->isPast());
        $this->assertFalse($m->isFuture());
    }
    
    /**
     * @covers Helpers\Calendar\Month::getName
     */
    public function testGetName() {
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
    }
    
    /**
     * @covers Helpers\Calendar\Month::getNameShort()
     */
    public function testGetNameShort() {
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
    }
    
    /**
     * @covers Helpers\Calendar\Month::getPrev()
     */
    public function testGetPrev() {
        $m1 = new Month(2018, 5);
        $this->assertEquals("201804", (string) $m1->getPrev());
        $m2 = new Month(2018, 1);
        $this->assertEquals("201712", (string) $m2->getPrev());
    }
    
    /**
     * @covers Helpers\Calendar\Month::getNext()
     */
    public function testGetNext() {
        $m1 = new Month(2018, 5);
        $this->assertEquals("201806", (string) $m1->getNext());
        $m2 = new Month(2018, 12);
        $this->assertEquals("201901", (string) $m2->getNext());
    }
    
    /**
     * @covers Helpers\Calendar\Month::hasDt()
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
