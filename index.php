<?php

require __DIR__ . '/vendor/autoload.php';

use Corbpie\NetworkSpeed;

//$filename = "1695921844_9S0EAS_ASIA";//2023.09.22 ASIA
//$filename = "adsdgdghfdhfhj";//HTTP 404 code
//$filename = "1699510871_9M4L81_GLOBAL";//2023.10.24 GLOBAL
//$filename = "1699940146_TXQDAS_NA";//2023.11.13 NORTH AMERICA
//$filename = "1700542086_ELGGKB_GLOBAL";//
$filename = "1701597762_TWF8ON_GLOBAL";//2023.12.01
//$filename = "1699555358_08KGSH_INDIA";//2023.10.24 INDIA
//$filename = "1695105636_FCDSD4_GLOBAL";//2023.09.04 GLOBAL
//$filename = "1693490247_21NFLN_NA";//2023.08.28 NORTH AMERICA

$ns = new NetworkSpeed\NetworkSpeed($filename);

echo $ns->outputAsJson();
