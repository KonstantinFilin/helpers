<?php

namespace Helpers\Calendar\Generators;

class WorkdaysGenerator extends DtListGenerator
{    
    /**
     * 
     * @param \Helpers\Calendar\Date $dt
     * @return boolean
     */
    protected function include(\Helpers\Calendar\Date $dt): bool {
        return !$dt->isSaturday() && !$dt->isSunday();
    }
}
