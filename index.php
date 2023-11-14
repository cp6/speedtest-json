<?php

require __DIR__ . '/vendor/autoload.php';

use Corbpie\NetworkSpeed;

//$id = "1695921844_9S0EAS_ASIA";//2023.09.22 ASIA
//$id = "adsdgdghfdhfhj";//HTTP 404
$id = "1699510871_9M4L81_GLOBAL";//2023.10.24 GLOBAL
//$id = "1699555358_08KGSH_INDIA";//2023.10.24 India
//$id = "1695105636_FCDSD4_GLOBAL";//2023.09.04 GLOBAL
//$id = "1693490247_21NFLN_NA";//2023.08.28 NORTH AMERICA

$ns = new NetworkSpeed\NetworkSpeed($id);

echo $ns->outputAsJson();
