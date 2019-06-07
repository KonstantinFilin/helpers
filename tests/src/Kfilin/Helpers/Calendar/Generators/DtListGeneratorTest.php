<?php

namespace Kfilin\Helpers\Calendar\Generators;

use Kfilin\Helpers\Calendar\Date;

class DtListGeneratorTest extends \PHPUnit\Framework\TestCase 
{
    /**
     * @covers Kfilin\Helpers\Calendar\Generators\DtListGenerator::__construct
     * @covers Kfilin\Helpers\Calendar\Generators\DtListGenerator::make
     * @covers Kfilin\Helpers\Calendar\Generators\DtListGenerator::include
     * @covers Kfilin\Helpers\Calendar\Generators\DtListGenerator::format
     */
    public function testMake() {
        $dt1 = new Date("2018-12-28");
        $dt2 = new Date("2019-01-04");
        $p1 = new \Kfilin\Helpers\Calendar\Period($dt1, $dt2);
        $g1 = new DtListGenerator($p1);
        
        $expected = [
            "2018-12-28",
            "2018-12-29",
            "2018-12-30",
            "2018-12-31",
            "2019-01-01",
            "2019-01-02",
            "2019-01-03",
            "2019-01-04"
        ];
        
        $this->assertEquals($expected, $g1->make());
        
        $g2 = new DtListGenerator($p1, "d.m.Y");
        
        $expected2 = [
            "28.12.2018",
            "29.12.2018",
            "30.12.2018",
            "31.12.2018",
            "01.01.2019",
            "02.01.2019",
            "03.01.2019",
            "04.01.2019"
        ];
        
        $this->assertEquals($expected2, $g2->make());
        
        $p3 = new \Kfilin\Helpers\Calendar\Period(new Date("2018-10-09"), new Date("2018-10-11"));
        $g3 = new DtListGenerator($p3, null);
        $actual = $g3->make();
        
        $this->assertCount(3, $actual);
        $expected3 = [
            "2018-10-09",
            "2018-10-10",
            "2018-10-11"
        ];
        
        foreach ($actual as $idx => $dt) {
            $this->assertTrue(is_a($dt, Date::class));
            $this->assertEquals($expected3[$idx], $dt->format("Y-m-d"));
        }
    }
}
