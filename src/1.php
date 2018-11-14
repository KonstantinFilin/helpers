<?php

require "../vendor/autoload.php";

$dt1 = new \Helpers\Calendar\Date("2018-12-25");
$dt2 = new \Helpers\Calendar\Date("2019-01-07");
$p1 = new Helpers\Calendar\Period($dt1, $dt2);
$g1 = new \Helpers\Calendar\Generator\PeriodDtListGenerator($p1);

$g1->asObj();
$dtList = $g1->make();
var_dump($dtList);
