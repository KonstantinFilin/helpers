<?php

namespace Kfilin\Helpers\Calendar;

/**
 * @see http://php.net/manual/en/book.datetime.php
 * @author Konstantin S. Filin
 */
class Date extends \DateTime
{    
    /**
     * @see http://php.net/manual/en/book.datetime.php
     */
    function __construct($time = "now", $object = null) {
        parent::__construct($time, $object);
    }

    /**
     * Returns weekday number
     * @return int Weekday number from 1 (Monday) to 7 (Sunday)
     */
    public function getWeekdayNum(): int
    {
        return $this->format("N");
    }
    
    /**
     * Returns day before given date
     * @param int $days How many days to go back
     * @return string Date before given date
     */
    public function getPrev(int $days = 1): Date
    {
        $dtObj = clone $this;
        $dtObj->sub(new \DateInterval("P" . $days . "D"));
        return $dtObj;
    }

    /**
     * Returns day after given date
     * @param int $days How many days to go forward
     * @return string Date after given date
     */
    public function getNext(int $days = 1): Date
    {
        $dtObj = clone $this;
        $dtObj->add(new \DateInterval("P" . $days . "D"));
        return $dtObj;
    }

    /**
     * Returns date as array
     * @return array Date as array. [ 0 => year, 1 => month, 2 => day ]
     */
    public function getAsArray(): array
    {
        return [
            $this->format("Y"),
            $this->format("m"),
            $this->format("d")
        ];
    }
    
    /**
     * Returns date as string
     * @return string Date as string in format YYYY-MM-DD
     */
    public function __toString(): string {
        return $this->format("Y-m-d");
    }
   
    /**
     * Checks if date is monday
     * @return bool True if yes
     */
    public function isMonday(): bool {
        return $this->getWeekdayNum() == 1;
    }
    
    /**
     * Checks if date is tuesday
     * @return bool True if yes
     */
    public function isTuesday(): bool {
        return $this->getWeekdayNum() == 2;
    }
    
    /**
     * Checks if date is wednesday
     * @return bool True if yes
     */
    public function isWednesday(): bool {
        return $this->getWeekdayNum() == 3;
    }
    
    /**
     * Checks if date is thursday
     * @return bool True if yes
     */
    public function isThursday(): bool {
        return $this->getWeekdayNum() == 4;
    }
    
    /**
     * Checks if date is friday
     * @return bool True if yes
     */
    public function isFriday(): bool {
        return $this->getWeekdayNum() == 5;
    }
    
    /**
     * Checks if date is saturday
     * @return bool True if yes
     */
    public function isSaturday(): bool {
        return $this->getWeekdayNum() == 6;
    }
    
    /**
     * Checks if date is sunday
     * @return bool True if yes
     */
    public function isSunday(): bool {
        return $this->getWeekdayNum() == 7;
    }
}
