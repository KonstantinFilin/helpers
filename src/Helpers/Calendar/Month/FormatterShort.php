<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

/**
 * Description of FormatterShort
 *
 * @author ksf
 */
class FormatterShort extends Formatter 
{

    /**
     * 
     * @return array
     */
    public function getWeekdayNames(): array
    {
        return [
            1 => "Mo",
            2 => "Tu",
            3 => "We",
            4 => "Th",
            5 => "Fr",
            6 => "Sa",
            7 => "Su"
        ];
    }
    
    /**
     * 
     * @return string
     */
    public function getName(Month $month): string
    {
        $monthNum = $month->getMonthNum();
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$monthNum]) ? $monthNames[$monthNum] : "???";
        return mb_substr($monthName, 0, 3)  . " " . $month->getYear();
    }
    
}
