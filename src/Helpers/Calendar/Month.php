<?php

namespace Helpers\Calendar;

class Month 
{
    /**
     * Year part 
     * @var int
     */
    protected $year;
    
    /**
     * Month number part
     * @var int
     */
    protected $month;
    
    /**
     * Creates month object from given period string in format YYYYMM
     * @param string $period Period string in format YYYYMM
     * @throws \InvalidArgumentException
     * @return Month Resulting object
     */
    public static function createFromPeriod(string $period): Month
    {       
        if (!preg_match("/^\d{6}$/", $period)) {
            throw new \InvalidArgumentException("Period must be 6 digits, argument value: " . $period);
        }
        
        $y = intval(substr($period, 0, 4));
        $m = intval(substr($period, -2));
        
        return new Month($y, $m);
    }
    
    /**
     * Creates month object from given date
     * @param string $dt Date string in format YYYY-MM-DD
     * @return Month Resulting object
     */
    public static function createFromDt(string $dt): Month
    {
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dt)) {
            throw new \InvalidArgumentException("Date must be in format YYYY-MM-DD, argument value: " . $dt);
        }
        
        list($y, $m, ) = explode('-', $dt, 3);        
        return new Month($y, $m);
    }

    /**
     * Creates class instanse
     * @param int $year Year part
     * @param int $month Month number part
     * @throws \InvalidArgumentException
     */
    function __construct(int $year = 0, int $month = 0) {
        
        if (!$year) {
            $year = date("Y");
        }
        
        if (!$month) {
            $month = date("m");
        }
        
        $this->year = intval($year);
        $this->month = intval($month);

        if ($month > 12 || $month < 1) {
            throw new \InvalidArgumentException("Month must be between 1 and 12 [argument value: " . $month . "]");
        }
    }

    /**
     * Returns date string of the current month from given month day num
     * @param int $dayNum Month day number
     * @return string Resulting date string in format YYYY-MM-DD
     */
    public function getFullDt(int $dayNum): string 
    {
        if ($dayNum < 1 || $dayNum > $this->getMaxDay()) {
            $mes = sprintf(
                "Day num must be between 1 and %d, argument value: %d",
                $this->getMaxDay(),
                $dayNum
            );
            throw new \InvalidArgumentException($mes);
        }
        
        return sprintf(
            "%04u-%02u-%02u",
            $this->getYear(),
            $this->getMonth(),
            $dayNum
        );
    }

    /**
     * Checks is given day is monday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isMonday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) === 1;
    }
    
    /**
     * Checks is given day is tuesday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isTuesday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 2;
    }
    
    /**
     * Checks is given day is wednesday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isWednesday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 3;
    }
    
    /**
     * Checks is given day is thursday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isThursday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 4;
    }
    
    /**
     * Checks is given day is friday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isFriday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 5;
    }
    
    /**
     * Checks is given day is saturday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isSaturday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 6;
    }
    
    /**
     * Checks is given day is sunday in this month
     * @param int $dayNum Month day number
     * @return bool True if yes
     */
    public function isSunday(int $dayNum): bool
    {
        return $this->getWeekdayNum($dayNum) == 7;
    }

    /**
     * Returns weekday name for given month day
     * @param int $dayNum Month day
     * @return string Weekday name (Monday, Tuesday, Wednesday, ...)
     */
    public function getWeekdayName(int $dayNum): string
    {
        $weekdayNum = $this->getWeekdayNum($dayNum);
        $weekdayNames = $this->getWeekdayNames();
        
        return $weekdayNames[$weekdayNum];
    }

    /**
     * Returns weekday name for given month day
     * @param int $dayNum Month day
     * @return string Weekday name (Monday, Tuesday, Wednesday, ...)
     */
    public function getWeekdayNameShort(int $dayNum): string
    {
        $weekdayNum = $this->getWeekdayNum($dayNum);
        $weekdayNames = $this->getWeekdayNamesShort();
        
        return $weekdayNames[$weekdayNum];
    }

    /**
     * 
     * @return array
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
            7 => "Sunday",
        ];
    }

    /**
     * 
     * @return array
     */
    public function getWeekdayNamesShort(): array
    {
        return [
            1 => "Mo",
            2 => "Tu",
            3 => "We",
            4 => "Th",
            5 => "Fr",
            6 => "Sa",
            7 => "Su",
        ];
    }

    /**
     * 
     * @return array
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
            12 => "December",
        ];
    }

    /**
     * 
     * @param int $day
     * @return int
     */
    public function getWeekdayNum(int $day): int
    {
        $curDt = $this->getFullDt($day);
        $dt = new \DateTime($curDt);

        return $dt->format("N");
    }

    /**
     * 
     * @return array
     */
    public function getWeekdayNumList(): array
    {
        $ret = [];
        $maxDay = $this->getMaxDay();
        
        for($day=1; $day<= $maxDay; $day++) {
            $ret[$day] = $this->getWeekdayNum($day);
        }
        
        return $ret;
    }

    /**
     * 
     * @return string
     */
    public function getMinDt(): string
    {
        return $this->getYear() . "-" . $this->getMonth() . "-01";
    }

    /**
     * 
     * @return string
     */
    public function getMaxDt(): string
    {
        return $this->getYear() . "-" . $this->getMonth() . "-" . $this->getMaxDay();
    }

    /**
     * 
     * @return int
     */
    public function getMaxDay(): int
    {
        $ret = [
            1 => 31,
            2 => 28,
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30, 
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31
        ];
        
        if ($this->isLeapYear()) {
            $ret[2] = 29;
        }
        
        return $ret[$this->month];
    }
    
    public function isLeapYear(): bool {
        if ($this->year%400 == 0) {
            return true;
        }
        
        if ($this->year%4 == 0 && $this->year%100 !== 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 
     * @return bool
     */
    public function isPast(): bool
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));

        return $curY > $this->year || ($curY == $this->year && $curM > $this->month);
    }
    
    /**
     * 
     * @return bool
     */
    public function isFuture(): bool
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));

        return $curY < $this->year || ($curY == $this->year && $curM < $this->month);
    }
    
    /**
     * 
     * @return bool
     */
    public function isCurrent(): bool
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));
        
        return $this->year == $curY && $this->month == $curM;
    }
    
    /**
     * 
     * @return string
     */
    public function getName(): string
    {
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$this->month]) ? $monthNames[$this->month] : "???";
        return $monthName . " " . $this->year;
    }
    
    /**
     * 
     * @return string
     */
    public function getNameShort(): string
    {
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$this->month]) ? $monthNames[$this->month] : "???";
        return mb_substr($monthName, 0, 3) . " " . $this->year;
    }

    /**
     * 
     * @return Month
     */
    public function getPrev(): Month
    {
        $m = $this->month;
        $y = $this->year;
        
        if ($m == 1) {
            $m = 12;
            $y--;
        } else {
            $m--;
        }
        
        if ($m < 10) {
            $m = "0" . $m;
        }
        
        return new Month($y, $m);
    }

    /**
     * 
     * @return Month
     */
    public function getNext(): Month
    {
        $m = $this->month;
        $y = $this->year;
        
        if ($m == 12) {
            $m = 1;
            $y++;
        } else {
            $m++;
        }
        
        if ($m < 10) {
            $m = "0" . $m;
        }
        
        return new self($y, $m);
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(): string
    {
        return $this->getYear() . $this->getMonth();
    }
    
    /**
     * 
     * @return int
     */
    public function getYear(): int {
        return $this->year;
    }

    /**
     * 
     * @return string
     */
    public function getMonth(): string {
        return $this->month < 10 ? "0" . $this->month : $this->month;
    }
    
    /**
     * 
     * @param string $dt
     * @return bool
     */
    public function hasDt(string $dt): bool
    {
        $monthOth = self::createFromDt($dt);
        return $this->getYear() == $monthOth->getYear() && $this->getMonth() == $monthOth->getMonth();
    }
}
