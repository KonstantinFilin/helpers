<?php

namespace Kfilin\Helpers\Calendar;

/**
 * Represents date period
 * 
 * @author Konstantin S. Filin
 */
class Period 
{
    /**
     * Start date
     * @var Date
     */
    protected $dt1;

    /**
     * Finish date
     * @var Date
     */
    protected $dt2;
    
    /**
     * 
     * @param \Helpers\Calendar\Date $dt1 Start date
     * @param \Helpers\Calendar\Date $dt2 Finish date
     */
    function __construct(Date $dt1, Date $dt2 = null) {
        $this->dt1 = $dt2 && ($dt1 > $dt2) ? $dt2 : $dt1;
        $this->dt2 = $dt2 && ($dt1 > $dt2) ? $dt1 : $dt2;
    }

    /**
     * Checks if period contains date
     * @param \Helpers\Calendar\Date $dt Date to check
     * @return bool True if yes
     */
    public function contains(Date $dt): bool 
    {
        if ($dt < $this->dt1) {
            return false;
        }
        
        if ($this->dt2 && $this->dt2 < $dt) {
            return false;
        }
        
        $now = new Date();
        
        if ($dt <= $now) {
            return true;
        }
        
        throw new \InvalidArgumentException(
            "Cannot check future date " . (string) $dt . " for unclosed period"
        );
    }
    
    /**
     * Checks if period is unclosed (has no finishing date)
     * @return bool True if yes
     */
    public function isUnclosed(): bool
    {
        return empty($this->dt2);
    }
    
    /**
     * Returns days amount in current period
     * @return int Days amount. If period unclosed and starting date in the past,
     * it is a difference for today. If starting date in the future, then 
     * 0 will be returned
     */
    public function length(): int
    {
        if (!$this->isUnclosed()) {
            return self::daysBetween($this->dt1, $this->dt2);
        }
        
        $now = new Date();
        
        if ($this->dt1 < $now) {
            return self::daysBetween($this->dt1, $now);
        }
        
        return 0;
    }
    
    /**
     * Returns days difference between two dates
     * @param \Helpers\Calendar\Date $dt1 Date # 1
     * @param \Helpers\Calendar\Date $dt2 Date # 2
     * @return int Days difference between two dates. If $dt2 is older then
     * negative value will be returned
     */
    public static function daysBetween(Date $dt1, Date $dt2): int {
//        var_dump($dt2->format("U") - $dt1->format("U"));
//        var_dump(($dt2->format("U") - $dt1->format("U")) / (3600 * 24)); die;
        return floor(($dt2->format("U") - $dt1->format("U")) / (3600 * 24));
    }
    
    /**
     * Returns starting date of the period
     * @return \Helpers\Calendar\Date Starting date
     */
    public function getDt1(): Date {
        return $this->dt1;
    }

    /**
     * Returns finishing date of the period
     * @return \Helpers\Calendar\Date Finishing date of the period. Can be null 
     * if period is unclosed
     */
    public function getDt2(): Date {
        return $this->dt2;
    }
}
