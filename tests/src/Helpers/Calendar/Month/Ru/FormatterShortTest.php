<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

use PHPUnit\Framework\TestCase;

use Helpers\Calendar\Month;
use Helpers\Calendar\Month\Ru\FormatterShort;

/**
 * Description of MonthFormatter
 *
 * @author ksf
 */
class FormatterRuShortTest extends TestCase
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
     * @covers Helpers\Calendar\Month\Ru\FormatterShort::getWeekdayNames
     */
    public function testGetWeekdayNames() 
    {
        $f1 = new FormatterShort();
        $expected = [
            1 => "Пн",
            2 => "Вт",
            3 => "Ср",
            4 => "Чт",
            5 => "Пт",
            6 => "Сб",
            7 => "Вс"
        ];
        $this->assertEquals($expected, $f1->getWeekdayNames());
    }    

    /**
     * @covers Helpers\Calendar\Month\Ru\FormatterShort::getMonthName
     */
    public function testGetMonthName()
    {
        $mf = new FormatterShort();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Янв 2018", $mf->getMonthName($m1));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Ноя 2018", $mf->getMonthName($m2));
    }

    /**
     * @covers Helpers\Calendar\Month\Ru\FormatterShort::getWeekdayName
     */
    public function testGetWeekdayName()
    {
        $mf = new FormatterShort();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Ср", $mf->getWeekdayName($m1, 31));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Чт", $mf->getWeekdayName($m2, 8));
    }
}
