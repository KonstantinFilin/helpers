<?php

namespace Kfilin\Helpers\Calendar\Generators;

/**
 * Generates workday (monday-friday) for given period
 */
class WorkdaysGenerator extends DtListGenerator
{    
    /**
     * {@inheritDoc}
     */
    protected function include(\Kfilin\Helpers\Calendar\Date $dt): bool {
        return !$dt->isSaturday() && !$dt->isSunday();
    }
}
