<?php

namespace Helpers\Calendar;

class Date 
{
    protected $day;
    protected $month;
    protected $year;
    
    /**
     * 
     * @param int $year
     * @param int $month
     * @param int $day
     */
    function __construct(int $year, int $month, int $day ) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * 
     * @return int
     */
    public function getWeekdayNum(): int
    {
        $dtObj = $this->getAsObj();
        
        return $dtObj->format("N");
    }
    
    /**
     * 
     * @param int $days
     * @return string
     */
    public function getPrev(int $days = 1): string
    {
        $dtObj = new \DateTime((string) $this);
        $dtObj->sub(new \DateInterval("P" . $days . "D"));
        return $dtObj->format("Y-m-d");
    }

    /**
     * 
     * @param int $days
     * @return string
     */
    public function getNext(int $days = 1): string
    {
        $dtObj = new \DateTime((string) $this);
        $dtObj->add(new \DateInterval("P" . $days . "D"));
        return $dtObj->format("Y-m-d");
    }

    /**
     * 
     * @return array
     */
    public function getAsArray(): array
    {
        return [
            $this->year,
            $this->month,
            $this->day
        ];
    }
    
    /**
     * 
     * @return \DateTime
     */
    public function getAsObj(): \DateTime
    {
        return new \DateTime((string) $this);
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return $this->year . "-" . $this->month . "-" . $this->day;
    }
   
    /**
     * 
     * @param string $date
     * @return Date
     */
    public static function createFromString(string $date): Date
    {
        list($year, $month, $day) = explode("-", $date);
        
        return new Date($year, $month, $day);
    }
    
    /**
     * 
     * @return \kfilin\Calendar\Date
     */
    public static function now(): Date
    {
        return new Date(date("d"), date("m"), date("Y"));
    }

    /**
     * 
     * @return bool
     */
    public function isMonday(): bool {
        return $this->getWeekdayNum() == 1;
    }
    
    /**
     * 
     * @return bool
     */
    public function isTuesday(): bool {
        return $this->getWeekdayNum() == 2;
    }
    
    /**
     * 
     * @return bool
     */
    public function isWednesday(): bool {
        return $this->getWeekdayNum() == 3;
    }
    
    /**
     * 
     * @return bool
     */
    public function isThursday(): bool {
        return $this->getWeekdayNum() == 4;
    }
    
    /**
     * 
     * @return bool
     */
    public function isFriday(): bool {
        return $this->getWeekdayNum() == 5;
    }
    
    /**
     * 
     * @return bool
     */
    public function isSaturday(): bool {
        return $this->getWeekdayNum() == 6;
    }
    
    /**
     * 
     * @return bool
     */
    public function isSanday(): bool {
        return $this->getWeekdayNum() == 7;
    }
}
