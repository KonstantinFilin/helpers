<?php

namespace Helpers\Calendar\Month;

use Helpers\Calendar\Month;
use Helpers\Calendar\Month\Fabric;
use Helpers\Calendar\Date;

/**
 * Information about dates in the month
 *
 * @author Konstantin S. Filin
 */
class Dt {
    
    /**
     *
     * @var Month
     */
    protected $month;
    
    /**
     * 
     * @param Month $month Month
     */
    function __construct(Month $month) {
        $this->month = $month;
    }
    
    /**
     * Returns date string of the current month from given month day num
     * @param int $dayNum Month day number
     * @return string Resulting date string in format YYYY-MM-DD
     */
    public function getAsStr(int $dayNum): string 
    {
        if ($dayNum < 1 || $dayNum > $this->maxDay()) {
            $mes = sprintf(
                "Day num must be between 1 and %d, argument value: %d",
                $this->maxDay(),
                $dayNum
            );
            throw new \InvalidArgumentException($mes);
        }
        
        return sprintf(
            "%04u-%02u-%02u",
            $this->month->getYear(),
            $this->month->getMonthNum(),
            $dayNum
        );
    }
    
    /**
     * Returns date object of the current month from given month day num
     * @param int $dayNum Month day number
     */
    public function getAsObj(int $dayNum): Date {
        return new Date(
            $this->month->getYear() . "-" .
            $this->month->getMonthNum() . "-" .
            $dayNum
        );
    }
    
    /**
     * Returns last day of the month 
     * @return string Last day of the month in format YYYY-mm-dd
     */
    public function max(): string
    {
        return sprintf(
            "%s-%02u-%02u",
            $this->month->getYear(),
            $this->month->getMonthNum(),
            $this->maxDay()
        );
    }

    /**
     * Returns days amount in this month
     * @return int Days amount in this month
     */
    public function maxDay(): int
    {
        $maxSecondMonth = \Helpers\Calendar\Year::isLeap($this->month->getYear()) ? 29 : 28;
        $ret = [
            1 => 31, 2 => $maxSecondMonth, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 
            7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31
        ];
        
        return $ret[$this->month->getMonthNum()];
    }
    
    /**
     * Returns first day of the month 
     * @return string First day of the month in format YYYY-mm-dd
     */
    public function min(): string
    {
        return sprintf("%s-%02u-01", 
            $this->month->getYear(),
            $this->month->getMonthNum()
        );
    }
    
    /**
     * Checks if given date belongs to given month
     * @param string $dt Date to check
     * @return bool True if yes
     */
    public function has(string $dt): bool
    {
        $monthOth = Fabric::createFromDt($dt);
        return $this->month->getYear() == $monthOth->getYear() 
            && $this->month->getMonthNum() == $monthOth->getMonthNum();
    }
}
