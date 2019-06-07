<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kfilin\Helpers\Calendar\Month\Ru;

use PHPUnit\Framework\TestCase;

use Kfilin\Helpers\Calendar\Month;
use Kfilin\Helpers\Calendar\Month\Ru\Formatter;

/**
 * Description of MonthFormatter
 *
 * @author ksf
 */
class FormatterRuTest extends TestCase
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
     * @covers Kfilin\Helpers\Calendar\Month\Ru\Formatter::getMonthNames
     */
    public function testGetMonthNames() 
    {
        $m1 = new Formatter();
        $expected = [
            1 => "Январь",
            2 => "Февраль",
            3 => "Март",
            4 => "Апрель",
            5 => "Май",
            6 => "Июнь",
            7 => "Июль",
            8 => "Август",
            9 => "Сентябрь",
            10 => "Октябрь",
            11 => "Ноябрь",
            12 => "Декабрь"
        ];
        $this->assertEquals($expected, $m1->getMonthNames());
    }  
    
    /**
     * @covers Kfilin\Helpers\Calendar\Month\Ru\Formatter::getWeekdayNames
     */
    public function testGetWeekdayNames() 
    {
        $m1 = new Formatter();
        $expected = [
            1 => "Понедельник",
            2 => "Вторник",
            3 => "Среда",
            4 => "Четверг",
            5 => "Пятница",
            6 => "Суббота",
            7 => "Воскресенье"
        ];
        $this->assertEquals($expected, $m1->getWeekdayNames());
    }    

    /**
     * @covers Kfilin\Helpers\Calendar\Month\Ru\Formatter::getMonthName
     */
    public function testGetMonthName()
    {
        $mf = new Formatter();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Январь 2018", $mf->getMonthName($m1));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Ноябрь 2018", $mf->getMonthName($m2));
    }

    /**
     * @covers Kfilin\Helpers\Calendar\Month\Ru\Formatter::getWeekdayName
     */
    public function testGetWeekdayName()
    {
        $mf = new Formatter();
        
        $m1 = new Month(2018, 1);
        $this->assertEquals("Среда", $mf->getWeekdayName($m1, 31));
        
        $m2 = new Month(2018, 11);
        $this->assertEquals("Четверг", $mf->getWeekdayName($m2, 8));
    }
}
