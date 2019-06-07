<?php

namespace Kfilin\Helpers\Str;

/**
 * Description of Random
 *
 * @author ksf
 */
class Random {
    /**
     * Creates random string of digits
     * @param integer $length Length of the string
     * @return string Random string of digits
     */
    public static function createNum (int $length): string {
        return self::create($length, range(0, 9));
    }

    /**
     * Creates random string
     * @param integer $length Length of the string
     * @param array|string $chars Chars the resulting string contains from.
     * Defaults is lowercase latin letters, digits and underscore sign
     * @return string Resulting string
     */
    public static function create(int $length, array $chars = []): string
    {
        if (!$chars) {
            $chars = [
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
                'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
                'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3',
                '4', '5', '6', '7', '8', '9', '_'
            ];
        }

        $str = '';
        
        for ($i = 1; $i <= $length; $i++) {
            $str .= $chars[array_rand($chars)];
        }

        return $str;
    }
    
}
