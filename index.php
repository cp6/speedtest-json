<?php

require __DIR__ . '/vendor/autoload.php';

use Corbpie\NetworkSpeed;

$ns = new NetworkSpeed\NetworkSpeed('1699510871_9M4L81_GLOBAL');
$data = $ns->fetchRaw();

preg_match('/Version\s*:\s*(.*?)\s/', $data, $matches);
$version = $matches[1];

preg_match('/CPU Model\s*:\s*(.*?)\s/', $data, $matches);
$cpuModel = $matches;

preg_match('/CPU Cores\s+:\s+(\d+) @ ([0-9.]+) MHz/', $data, $matches);
$cpu_cores = $matches[1];
$cpu_frequency = $matches[2];

preg_match('/Total Disk\s*:\s*([\d.]+)\s*(\w+)\s*\(.*\)\s/', $data, $matches);
$disk_value = (float)$matches[1];
$disk_unit = $matches[2];

preg_match('/Total RAM\s*:\s*([\d.]+)\s*(\w+)\s*\(.*\)\s/', $data, $matches);
$ram_value = (float)$matches[1];
$ram_unit = $matches[2];

preg_match('/Total Swap\s*:\s*([\d.]+)\s*(\w+)\s*\(.*\)\s/', $data, $matches);
$swap_value = (float)$matches[1];
$swap_unit = $matches[2];

preg_match('/System uptime\s*:\s*(.*?)\s/', $data, $matches);
$uptime = $matches[1];

preg_match('/Load average\s*:\s*(.*?)\s/', $data, $matches);
$loadAverage = $matches[1];

preg_match('/OS\s*:\s*(.*?)\s/', $data, $matches);
$os = $matches[1];

preg_match('/Arch\s*:\s*(.*?)\s/', $data, $matches);
$arch = $matches[1];

preg_match('/Kernel\s*:\s*(.*?)\s/', $data, $matches);
$kernel = $matches[1];

preg_match('/Primary Network\s*:\s*(.*?)\s/', $data, $matches);
$primaryNetwork = $matches[1];

preg_match('/IPv6 Access\s*:\s*(.*?)\s/', $data, $matches);
$ipv6Access = $matches[1] === '✔';

preg_match('/IPv4 Access\s*:\s*(.*?)\s/', $data, $matches);
$ipv4Access = $matches[1] === '✔';

preg_match('/ISP\s*:\s*(.*?)\s/', $data, $matches);
$isp = $matches[1];

preg_match('/ASN\s*:\s*(.*?)\s/', $data, $matches);
$asn = $matches[1];

preg_match('/Host\s*:\s*(.*?)\s/', $data, $matches);
$host = $matches[1];

preg_match('/Location\s*:\s*(.*?)\s/', $data, $matches);
$location = $matches[1];

preg_match('/Total Disk\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $diskMatches);
preg_match('/Total RAM\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $ramMatches);
preg_match('/Total Swap\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $swapMatches);


preg_match('/CPU Model\s+:\s+([^\n]+)/', $data, $matches);
$cpu = $matches[1];
$cpu_model = trim(str_replace("CPU Model:", "", strstr($cpu, '@', true)));
$cpu_freq_stock = trim(str_replace("@", "", strstr($cpu, '@', false)));


// Create JSON structure
$jsonData = [
    'version' => $version,
    'region' => preg_match('/Region:\s+([^)]+)/', $data, $matches) ? trim($matches[1]) : null,
    'system' => [
        'cpu' => [
            'model' => $cpu_model,
            'base_freq' => $cpu_freq_stock,
            'cores' => $cpu_cores,
            'freq' => $cpu_frequency,
        ],
        'ram' => [
            'value' => $ram_value,
            'unit' => $ram_unit,
            'used' => $ramMatches[2]
        ],
        'swap' => [
            'value' => $swap_value,
            'unit' => $swap_unit,
        ],
        'disk' => [
            'value' => $disk_value,
            'unit' => $disk_unit,
            'used' => $diskMatches[2],
        ],
        'uptime' => preg_match('/System uptime\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("System uptime", "", $matches[1])) : null,
        'load' => preg_match('/Load average\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("Load average", "", $matches[1])) : null,
        'os' => preg_match('/OS\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("OS", "", $matches[1])) : null,
        'arch' => preg_match('/Arch\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("Arch", "", $matches[1])) : null,
        'kernel' => $kernel,
    ],
    'network' => [
        'primary_network' => $primaryNetwork,
        'ipv6_access' => $ipv6Access,
        'ipv4_access' => $ipv4Access,
        'isp' => preg_match('/ISP\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("ISP", "", $matches[1])) : null,
        'asn' => preg_match('/ASN\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("ASN", "", $matches[1])) : null,
        'host' => preg_match('/Host\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("Host", "", $matches[1])) : null,
        'location' => preg_match('/Location\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("Location", "", $matches[1])) : null,
    ],
];


echo json_encode($jsonData, JSON_PRETTY_PRINT);
