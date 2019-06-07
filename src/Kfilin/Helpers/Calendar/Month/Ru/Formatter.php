<?php

namespace Kfilin\Helpers\Calendar\Month\Ru;

use Kfilin\Helpers\Calendar\Month;

/**
 * Month data formatter
 * @author Konstantin S. Filin
 */
class Formatter extends \Kfilin\Helpers\Calendar\Month\Formatter
{
    /**
     * Returns list of month names
     * @return array List of month names
     */
    public function getMonthNames(): array
    {
        return [
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
    }

    /**
     * Returns list of weekday names
     * @return array List of weekday names
     */
    public function getWeekdayNames(): array
    {
        return [
            1 => "Понедельник",
            2 => "Вторник",
            3 => "Среда",
            4 => "Четверг",
            5 => "Пятница",
            6 => "Суббота",
            7 => "Воскресенье"
        ];
    }
}
