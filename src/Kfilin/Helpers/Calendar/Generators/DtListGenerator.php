<?php

namespace Kfilin\Helpers\Calendar\Generators;

use Kfilin\Helpers\Calendar\Date;

/**
 * Generates date list from period object
 *
 * @author Konstantin S. Filin
 */
class DtListGenerator implements \Kfilin\Helpers\Calendar\GeneratorIf {
    
    /**
     *
     * @var \Helpers\Calendar\Period
     */
    protected $period;
    
    /**
     *
     * @var string
     */
    protected $format;
    
    public function __construct(\Kfilin\Helpers\Calendar\Period $period, $format = "Y-m-d") {
        $this->period = $period;
        $this->format = $format;
    }
        
    /**
     * {@inheritDoc}
     */
    public function make(): array {
        $dt1 = $this->period->getDt1();
        $dt2 = $this->period->getDt2() ?: new \Helpers\Calendar\Date;
        
        $ts = $dt1->format("U");
        $ts2 = $dt2->format("U");
        
        $ret = [];
        
        while ($ts < $ts2) {
            $dt = new Date(date("Y-m-d", $ts));

            if ($this->include($dt)) {
                $ret[] = $this->format($dt);
            }
            
            $ts += 3600 * 24;
        }
        
        if ($this->include($dt2)) {
            $ret[] = $this->format($dt2);
        }
        
        return $ret;
    }
    
    /**
     * Whether to include given date into the list
     * @param Date $dt Tested date
     * @return bool True if yes
     */
    protected function include(Date $dt): bool
    {
        return true;
    }
    
    /**
     * Formats date for the list
     * @param Date $dt Given date
     * @return string|Date Formatted date
     */
    private function format(Date $dt)
    {
        return $this->format 
            ? $dt->format($this->format) 
            : $dt;
    }
}
