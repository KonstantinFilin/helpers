<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Calendar\Generators;

use Helpers\Calendar\Date;

/**
 * Generates date list from period object
 *
 * @author Konstantin S. Filin
 */
class DtListGenerator implements \Helpers\Calendar\GeneratorIf {
    
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
    
    public function __construct(\Helpers\Calendar\Period $period, $format = "Y-m-d") {
        $this->period = $period;
        $this->format = $format;
    }
        
    /**
     * 
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
        
        $ret[] = $this->format($dt2);
        
        return $ret;
    }
    
    /**
     * 
     * @param Date $dt
     * @return bool
     */
    protected function include(Date $dt): bool
    {
        return true;
    }
    
    /**
     * 
     * @param Date $dt
     * @return type
     */
    private function format(Date $dt)
    {
        return $this->format 
            ? $dt->format($this->format) 
            : $dt;
    }
}
