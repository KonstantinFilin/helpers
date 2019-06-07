<?php

namespace Kfilin\Helpers;

class Debug 
{
    public static function getMemoryUsage() {
        return [
            memory_get_usage(),
            memory_get_usage(true),
            memory_get_peak_usage(),
            memory_get_peak_usage(true)
        ];
    }
    
    public static function getFreeMemory() {
        list( , $mem1) = explode(":", exec('cat /proc/meminfo | grep "MemFree"'));
        return $mem1;
    }
    
    public static function getStackTrace() {
        $stack = debug_backtrace();       
        $stackLines = [];

        foreach ($stack as $step) {
            $stackLines[] = sprintf(
                "%s:%u %s::%s",
                !empty($step["file"]) ? $step["file"] : "-= no file =-",
                !empty($step["line"]) ? $step["line"] : 0,
                !empty($step["class"]) ? $step["class"] : "-= no class =-",
                !empty($step["function"]) ? $step["function"] : "-= no function =-"
            );
        }
        
        return $stackLines;
    }
}
