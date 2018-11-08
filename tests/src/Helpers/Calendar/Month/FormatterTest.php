<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;

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
     * @covers Helpers\Calendar\Month\Formatter::getMonthNames
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
            12 => "December",
        ];
        $this->assertEquals($expected, $m1->getMonthNames());
    }  
    
    /**
     * @covers Helpers\Calendar\Month\Formatter::getWeekdayNames
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
            7 => "Sunday",
        ];
        $this->assertEquals($expected, $m1->getWeekdayNames());
    }    

    /**
     * @covers Helpers\Calendar\Month\Formatter::getWeekdayNamesShort
     */
    public function testGetWeekdayNamesShort() 
    {
        $m1 = new Formatter();
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
    
    
}
