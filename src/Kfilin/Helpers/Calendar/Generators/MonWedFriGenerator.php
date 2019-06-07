<?php

namespace Kfilin\Helpers\Calendar\Generators;

/**
 * Generates workday (monday-friday) for given period
 */
class MonWedFriGenerator extends DtListGenerator
{    
    /**
     * {@inheritDoc}
     */
    protected function include(\Kfilin\Helpers\Calendar\Date $dt): bool {
        return $dt->isMonday() || $dt->isWednesday() || $dt->isFriday();
    }
}
