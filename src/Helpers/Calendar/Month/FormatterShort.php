<?php

namespace Helpers\Calendar\Month;

use Helpers\Calendar\Month;

/**
 * Month data formatter
 * @author Konstantin S. Filin
 */
class FormatterShort extends Formatter 
{

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getMonthName(Month $month): string
    {
        $monthNum = $month->getMonthNum();
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$monthNum]) ? $monthNames[$monthNum] : "???";
        return mb_substr($monthName, 0, 3)  . " " . $month->getYear();
    }
    
}
