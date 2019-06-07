<?php

namespace Kfilin\Helpers\Calendar\Month\Ru;

use Kfilin\Helpers\Calendar\Month;

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
            1 => "Пн",
            2 => "Вт",
            3 => "Ср",
            4 => "Чт",
            5 => "Пт",
            6 => "Сб",
            7 => "Вс"
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
