<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kfilin\Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;

use Kfilin\Helpers\Calendar\Month;
use Kfilin\Helpers\Calendar\Month\FormatterShort;

/**
 * Description of MonthFormatter
 *
 * @author ksf
 */
class FormatterShortTest  extends TestCase
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
     * @covers Kfilin\Helpers\Calendar\Month\FormatterShort::getWeekdayNames
     */
    public function testGetWeekdayNames() 
    {
        $f1 = new FormatterShort();
        $expected = [
            1 => "Mo",
            2 => "Tu",
            3 => "We",
            4 => "Th",
            5 => "Fr",
            6 => "Sa",
            7 => "Su"
        ];
        $this->assertEquals($expected, $f1->getWeekdayNames());
    }    

    /**
     * @covers Kfilin\Helpers\Calendar\Month\FormatterShort::getMonthName
     */
    public function testGetMonthName()
    {
        $mf = new FormatterShort();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Jan 2018", $mf->getMonthName($m1));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Nov 2018", $mf->getMonthName($m2));
    }

    /**
     * @covers Kfilin\Helpers\Calendar\Month\FormatterShort::getWeekdayName
     */
    public function testGetWeekdayName()
    {
        $mf = new FormatterShort();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("We", $mf->getWeekdayName($m1, 31));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Th", $mf->getWeekdayName($m2, 8));
    }
}
