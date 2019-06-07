<?php

namespace Kfilin\Helpers\Calendar\Month;

use Kfilin\Helpers\Calendar\Month;

/**
 * Description of Fabric
 *
 * @author Konstantin S. Filin
 */
class Fabric {

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
     * Returns previous month
     * @param Month $month
     * @return Month
     */
    public static function getPrev(Month $month): Month
    {
        $m = $month->getMonthNum();
        $y = $month->getYear();
        
        if ($m == 1) {
            $m = 12;
            $y--;
        } else {
            $m--;
        }
        
        return new Month($y, $m);
    }

    /**
     * Returns next month
     * @param Month $month
     * @return Month
     */
    public static function getNext(Month $month): Month
    {
        $m = $month->getMonthNum();
        $y = $month->getYear();
        
        if ($m == 12) {
            $m = 1;
            $y++;
        } else {
            $m++;
        }
        
        return new Month($y, $m);
    }
}
