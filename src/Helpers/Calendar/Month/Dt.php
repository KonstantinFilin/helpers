<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Month;

use Helpers\Calendar\Month;
use Helpers\Calendar\Month\Fabric;
use Helpers\Calendar\Date;

/**
 * Description of Ranges
 *
 * @author ksf
 */
class Dt {
    
    /**
     *
     * @var Month
     */
    protected $month;
    
    function __construct(Month $month) {
        $this->month = $month;
    }
    
    /**
     * Returns date string of the current month from given month day num
     * @param Month $this Month object
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
     * 
     * @param int $dayNum
     * @return Date
     */
    public function getAsObj(int $dayNum): Date {
        return new Date(
            $this->month->getYear(), 
            $this->month->getMonthNum(), 
            $dayNum
        );
    }
    
    /**
     * 
     * @param Month $month
     * @return string
     */
    public function max(): string
    {
        return sprintf(
            "%s-%s-%s",
            $this->month->getYear(),
            $this->month->getMonthNum(),
            $this->month->getMaxDay()
        );
    }

    /**
     * 
     * @return int
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
     * 
     * @return string
     */
    public function min(): string
    {
        return sprintf("%s-%s-01", 
            $this->month->getYear(),
            $this->month->getMonthNum()
        );
    }
    
    /**
     * 
     * @param string $dt
     * @return bool
     */
    public function has(string $dt): bool
    {
        $monthOth = Fabric::createFromDt($dt);
        return $this->month->getYear() == $monthOth->getYear() 
            && $this->month->getMonthNum() == $monthOth->getMonthNum();
    }
}
