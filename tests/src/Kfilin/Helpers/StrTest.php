<?php

namespace Kfilin\Helpers;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2018-10-28 at 18:33:51.
 */
class StrTest extends TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }


    /**
     * @covers Helpers\Str::limitWords
     * @todo   Implement testLimitWords().
     */
//    public function testLimitWords() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }

    /**
     * @covers Kfilin\Helpers\Str::limitChars
     */
    public function testLimitCharsDefaultEnd() {
        $this->assertEquals("ab...", Str::limitChars("abcdefg", 5));
        $this->assertEquals("ab", Str::limitChars("abcdefg", 2));
        $this->assertEquals("abcde", Str::limitChars("abcdefg", 5, "******"));
    }
    
    /**
     * @covers Kfilin\Helpers\Str::limitChars
     * @dataProvider limitCharsProvider
     */
    public function testLimitChars($str, $len, $end, $expected) {
        $this->assertEquals($expected, Str::limitChars($str, $len, $end));
    }
    
    public function limitCharsProvider() {
        return [
            [ "abcdefghigklmno",  5, "..", "abc.."],
            [ "abcdefghigklmno",  5, "***", "ab***"],
            [ "abc",  5, "***", "abc"],
            [ "abcdefghigklmno",  12, "#####", "abcdefg#####"],
        ];
    }

    public function startsWithProvider()
    {
        return [
            [ "", "", false ],
            [ "", "a", false ],
            [ "a", "", false ],
            [ "abcdef", "a", true ],
            [ "abcdef", "ab", true ],
            [ "abcdef", "abc", true ],
            [ "abcdef", "abcd", true ],
            [ "abcdef", "abcdef", true ],
            [ "abcdef", "abdcef", false ],
            [ "abcdef", "ef", false ],
            [ "abc", "cdef", false ],
            [ "abcdef", "bc", false ],
            [ "abc", "abcdef", false ]
        ];
    }
    
    /**
     * @covers Kfilin\Helpers\Str::startsWith
     * @dataProvider startsWithProvider
     */
    public function testStartsWith($str, $start, $expected) {
        $this->assertEquals($expected, Str::startsWith($str, $start));
    }

    public function endsWithProvider()
    {
        return [
            [ "", "", false ],
            [ "", "a", false ],
            [ "a", "", false ],
            [ "abcdef", "f", true ],
            [ "abcdef", "ef", true ],
            [ "abcdef", "def", true ],
            [ "abcdef", "abcdef", true ],
            [ "abcdef", "abdcef", false ],
            [ "abcdef", "de", false ],
            [ "abc", "cdef", false ],
            [ "abc", "abcdef", false ]
        ];
    }
    
    /**
     * @covers Kfilin\Helpers\Str::endsWith
     * @dataProvider endsWithProvider
     */
    public function testEndsWith($str, $end, $expected) {
        $this->assertEquals($expected, Str::endsWith($str, $end));
    }

}
