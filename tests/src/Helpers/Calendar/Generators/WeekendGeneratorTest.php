<?php

namespace Helpers\Calendar\Generators;

use Helpers\Calendar\Date;

/**
 * Description of WeekendGeneratorTest
 *
 * @author Konstantin S. Filin
 */
class WeekendGeneratorTest extends \PHPUnit\Framework\TestCase {
    
    /**
     * @covers Helpers\Calendar\Generators\WorkdaysGenerator::include
     */
    public function testInclude() {
        $dt1 = new Date("2018-11-15");
        $dt2 = new Date("2018-11-20");

        $p1 = new \Helpers\Calendar\Period($dt1, $dt2);
        $g1 = new WorkdaysGenerator($p1);
        
        $expected = [
            "2018-11-15",
            "2018-11-16",
            "2018-11-19",
            "2018-11-20"
        ];
        
        $this->assertEquals($expected, $g1->make());
    }
}
