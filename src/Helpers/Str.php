<?php
namespace Helpers;

/**
 * String helper
 */
class Str
{
    const LETTERS = 'ABCDEEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    const LETTERS_UPPER = 'ABCDEEFGHIJKLMNOPQRSTUVWXYZ';
    const LETTERS_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    const DIGITS = '0123456789';

    /**
     * Creates random string of digits
     * @param integer $length Length of the string
     * @return string Random string of digits
     */
    public static function createRandomNum (int $length): string {
        return self::createRandom($length, range(0, 9));
    }

    /**
     * Creates random string
     * @param integer $length Length of the string
     * @param array|string $chars Chars the resulting string contains from.
     * Defaults is lowercase latin letters, digits and underscore sign
     * @return string Resulting string
     */
    public static function createRandom(int $length, array $chars = []): string
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
    
    /**
     * Limits string to a given number of chars
     * @param string $str Source string
     * @param int $limit Destination string length. If its length more than 
     *          source string the latter will be returned
     * @param string $end Ending suffix. Defaults to '...' (three points). 
     *          If its length equals or more than $str it turns to an empty string
     * @return string Resulting string
     */
    public static function limitChars(string $str, int $limit, string $end = "..."): string
    {
        if (mb_strlen($str) <= $limit) {
            return $str;
        }
        
        $endLen = mb_strlen($end);
        
        if ($limit <= $endLen) {
            $endLen = 0;
            $end = '';
        }        
        
        return mb_substr($str, 0, $limit - $endLen) . $end;
    }

    /**
     * Checks is haystack string starts with needle string
     * @param string $str Haystack string
     * @param string $start Needle string
     * @return bool True if yes
     */
    public static function startsWith(string $str, string $start): bool
    {
        if (!$start) {
            return false;
        }
        
        return mb_substr($str, 0, mb_strlen($start)) === $start;
    }

    /**
     * Checks is haystack string ends with needle string
     * @param string $str Haystack string
     * @param string $end Needle string
     * @return bool True if yes
     */
    public static function endsWith(string $str, string $end): bool
    {
        if (!$end) {
            return false;
        }
        
        return mb_substr($str, -1 * mb_strlen($end)) === $end;
    }
}
