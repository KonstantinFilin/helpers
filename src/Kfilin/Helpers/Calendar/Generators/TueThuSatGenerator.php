<?php

namespace Kfilin\Helpers\Calendar\Generators;

/**
 * Generates workday (monday-friday) for given period
 */
class TueThuSatGenerator extends DtListGenerator
{    
    /**
     * {@inheritDoc}
     */
    protected function include(\Kfilin\Helpers\Calendar\Date $dt): bool {
        return $dt->isTuesday() || $dt->isThursday() || $dt->isSaturday();
    }
}
