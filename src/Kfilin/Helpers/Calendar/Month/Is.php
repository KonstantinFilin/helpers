<?php

namespace Kfilin\Helpers\Calendar\Month;

use Kfilin\Helpers\Calendar\Month;
use Kfilin\Helpers\Calendar\Date;

/**
 * Month attributes checker
 * @author Konstantin S. Filin
 */
class Is {
    
    /**
     *
     * @var Month
     */
    protected $month;
    
    function __construct(Month $month) {
        $this->month = $month;
    }
    
    /**
     * Checks if month is in current year
     * @return bool True if yes
     */
    public function currentYear(): bool {
        $now = new Date();
        return $this->month->getYear() == $now->format("Y");
    }
    
    /**
     * Checks if it is current month
     * @return bool True if yes
     */
    public function current(): bool
    {
        $now = new Date();

        return $this->month->is()->currentYear() 
            && $this->month->getMonthNum() == intval($now->format("m"));
    }

    /**
     * Checks if month is in a past
     * @return bool True if yes
     */
    public function past(): bool
    {
        $now = new Date();
        $condition1 = intval($now->format("Y")) > $this->month->getYear();
        $condition2 = $this->month->is()->currentYear()
            && intval($now->format("m")) > $this->month->getMonthNum();

        return $condition1 || $condition2;
    }
    
    /**
     * Checks if month is in a future
     * @return bool True if yes
     */
    public function future(): bool
    {
        $now = new Date();
        $condition1 = intval($now->format("Y")) < $this->month->getYear();
        $condition2 = $this->month->is()->currentYear()
            && intval($now->format("m")) < $this->month->getMonthNum();

        return $condition1 || $condition2;
    }
}
