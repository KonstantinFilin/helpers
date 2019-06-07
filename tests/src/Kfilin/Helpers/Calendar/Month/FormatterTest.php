<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kfilin\Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;

use Kfilin\Helpers\Calendar\Month;
use Kfilin\Helpers\Calendar\Month\Formatter;

/**
 * Description of MonthFormatter
 *
 * @author ksf
 */
class FormatterTest  extends TestCase
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
     * @covers Kfilin\Helpers\Calendar\Month\Formatter::getMonthNames
     */
    public function testGetMonthNames() 
    {
        $m1 = new Formatter();
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
            12 => "December"
        ];
        $this->assertEquals($expected, $m1->getMonthNames());
    }  
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Formatter::getWeekdayNames
     */
    public function testGetWeekdayNames() 
    {
        $m1 = new Formatter();
        $expected = [
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday"
        ];
        $this->assertEquals($expected, $m1->getWeekdayNames());
    }    

    /**
     * @covers Kfilin\Helpers\Calendar\Month\Formatter::getMonthName
     */
    public function testGetMonthName()
    {
        $mf = new Formatter();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("January 2018", $mf->getMonthName($m1));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("November 2018", $mf->getMonthName($m2));
    }

    /**
     * @covers Kfilin\Helpers\Calendar\Month\Formatter::getWeekdayName
     */
    public function testGetWeekdayName()
    {
        $mf = new Formatter();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Wednesday", $mf->getWeekdayName($m1, 31));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Thursday", $mf->getWeekdayName($m2, 8));
    }
}
