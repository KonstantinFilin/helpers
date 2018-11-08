<?php

namespace Helpers\Calendar\Month;

use Helpers\Calendar\Month;

/**
 * Description of Info
 *
 * @author ksf
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
     * 
     * @return bool
     */
    public function currentYear(): bool {
        return $this->getYear() == Now::year();
    }
    
    /**
     * 
     * @return bool
     */
    public function current(): bool
    {       
        return $this->isCurrentYear() && $this->getMonth() == Now::monthNum();
    }
    

    /**
     * 
     * @return bool
     */
    public function past(): bool
    {
        $condition1 = Now::year() > $this->getYear();
        $condition2 = $this->isCurrentYear()
            && Now::monthNum() > $this->getMonth();

        return $condition1 || $condition2;
    }
    
    /**
     * 
     * @return bool
     */
    public function future(): bool
    {
        $condition1 = Now::year() < $this->getYear();
        $condition2 = $this->isCurrentYear()
            && Now::monthNum() < $this->getMonth();

        return $condition1 || $condition2;
    }
}
