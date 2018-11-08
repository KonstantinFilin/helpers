<?php

namespace Helpers\Calendar;

/**
 * Description of Year
 *
 * @author ksf
 */
class Year {
    public static function isLeap(int $year): bool {
        $condition1 = $year % 400 == 0;
        $condition2 = $year % 4 == 0 && $year % 100 !== 0;
        
        return $condition1 || $condition2;
    }
}
