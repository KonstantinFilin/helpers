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
     * 
     * @param string $str
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function limitChars(string $str, int $limit, string $end = "..."): string
    {
        return mb_substr($str, 0, $limit) . $end;
    }

    /**
     * 
     * @param string $str
     * @param string $start
     * @return string
     */
    public static function startsWith(string $str, string $start): bool
    {
        return mb_substr($str, 0, mb_strlen($start)) === $start;
    }

    /**
     * 
     * @param string $str
     * @param string $end
     * @return string
     */
    public static function endsWith(string $str, string $end): bool
    {
        return mb_substr($str, -1 * mb_strlen($end)) === $end;
    }
}
