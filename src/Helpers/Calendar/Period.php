<?php

namespace kfilin\Calendar;

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
     * @param \kfilin\Calendar\Date $dt1 Start date
     * @param \kfilin\Calendar\Date $dt2 Finish date
     */
    function __construct(Date $dt1, Date $dt2) {
        $this->dt1 = $dt1;
        $this->dt2 = $dt2;
    }

    /**
     * Checks if period contains date
     * @param \kfilin\Calendar\Date $dt Date to check
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
        
        return true;
    }
}
