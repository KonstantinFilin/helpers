<?php

namespace Helpers\Calendar\Generator;

use Helpers\Calendar\Month;

class Workdays implements \Helpers\Calendar\GeneratorIf
{
    /**
     *
     * @var \Helpers\Calendar\Month
     */
    protected $month;
    
    function __construct(Month $month) {
        $this->month = $month;
    }
    
    /**
     * 
     * {@inheritDoc}
     */
    public function make(): array 
    {
        $maxDay = $this->month->getMaxDay();
        $ret = [];
        
        for ($dayNum = 1; $dayNum <= $maxDay; $dayNum++) {
            if ($this->isWeekend($dayNum)) {
                continue;
            }
            
            $ret[] = $this->month->getFullFromDayNum($dayNum);
        }
        
        return $ret;
    }
    
    /**
     * 
     * @param int $dayNum
     * @return bool
     */
    private function isWeekend(int $dayNum): bool
    {
        return $this->month->isSaturday($dayNum) || $this->month->isSunday($dayNum);
    }

}
