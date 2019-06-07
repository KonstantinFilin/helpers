<?php

namespace Kfilin\Helpers\Calendar\Generators;

/**
 * Generates weekends (saturday-sunday) for given period
 */
class WeekendsGenerator extends DtListGenerator
{    
    /**
     * {@inheritDoc}
     */
    protected function include(\Kfilin\Helpers\Calendar\Date $dt): bool {
        return $dt->isSaturday() || $dt->isSunday();
    }
}
