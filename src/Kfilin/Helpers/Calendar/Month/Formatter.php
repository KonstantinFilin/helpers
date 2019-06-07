<?php

namespace Kfilin\Helpers\Calendar\Month;

use Kfilin\Helpers\Calendar\Month;

/**
 * Month data formatter
 * @author Konstantin S. Filin
 */
class Formatter 
{

    /**
     * Returns weekday name for given month day
     * @param Month Month object
     * @param int $dayNum Month day
     * @return string Weekday name (Monday, Tuesday, Wednesday, ...)
     */
    public function getWeekdayName(Month $month, int $dayNum): string
    {
        $weekdayNum = $month->dt()->getAsObj($dayNum)->getWeekdayNum();
        $weekdayNames = $this->getWeekdayNames();
        
        return $weekdayNames[$weekdayNum];
    }

    /**
     * Returns list of month names
     * @return array List of month names
     */
    public function getMonthNames(): array
    {
        return [
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
    }

    /**
     * Returns list of weekday names
     * @return array List of weekday names
     */
    public function getWeekdayNames(): array
    {
        return [
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday"
        ];
    }
    
    /**
     * Returns month name
     * @param Month $month
     * @return string Month name in format "MonthName year"
     */
    public function getMonthName(Month $month): string
    {
        $monthNum = $month->getMonthNum();
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$monthNum]) ? $monthNames[$monthNum] : "???";
        return $monthName . " " . $month->getYear();
    }
}
