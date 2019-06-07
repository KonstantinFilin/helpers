<?php

require "../vendor/autoload.php";

use Kfilin\Helpers\Calendar\Date;
use Kfilin\Helpers\Calendar\Period;
use Kfilin\Helpers\Calendar\Generators\WeekendsGenerator;
use Kfilin\Helpers\Calendar\Generators\WorkdaysGenerator;

$dt1 = new Date("2019-06-04");
$dt2 = new Date("2019-09-27");
$p1 = new Period($dt1, $dt2);
$g1 = new WeekendsGenerator($p1);

$dt21 = new Date("2019-02-01");
$dt22 = new Date("2019-02-28");
$p2 = new Period($dt21, $dt22);
$g2 = new WorkdaysGenerator($p2);
//$g1->asObj();
$dtList = $g2->make();
var_dump($dtList);

