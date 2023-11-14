<?php

namespace Corbpie\NetworkSpeed;


class NetworkSpeed
{

    public string $id;

    public string $contents;

    public array $parsed;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function fetchRaw(): bool|string
    {
        $url = "https://result.network-speed.xyz/r/{$this->id}.txt";

        $headers = [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0',
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code !== 200 || curl_errno($ch)) {
            return false;
        }

        curl_close($ch);

        return $this->contents = $response;
    }

    public function asJson(): array
    {
        $data = $this->contents;

        preg_match('/Version\s*:\s*(.*?)\s/', $data, $matches);
        $version = str_replace("v", "", $matches[1]);

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
        $swap_value = $matches[1] ?? null;
        $swap_unit = $matches[2] ?? null;

        preg_match('/Kernel\s*:\s*(.*?)\s/', $data, $matches);
        $kernel = $matches[1];

        preg_match('/Primary Network\s*:\s*(.*?)\s/', $data, $matches);
        $primaryNetwork = $matches[1];

        preg_match('/IPv6 Access\s*:\s*(.*?)\s/', $data, $matches);
        $ipv6Access = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/IPv4 Access\s*:\s*(.*?)\s/', $data, $matches);
        $ipv4Access = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/Total Disk\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $diskMatches);
        preg_match('/Total RAM\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $ramMatches);
        preg_match('/CPU Model\s+:\s+([^\n]+)/', $data, $matches);

        $cpu = $matches[1];

        if (!str_contains($cpu, "@")) {
            $cpu_model = trim($cpu);
            $cpu_freq_stock = null;
        } else {
            $cpu_model = trim(str_replace("CPU Model:", "", strstr($cpu, '@', true)));
            $cpu_freq_stock = (float)trim(str_replace(["@", "GHz"], "", strstr($cpu, '@', false)));
        }

        $time_string = preg_match('/System uptime\s+:\s+(.+)/', $data, $matches) ? trim(str_replace("System uptime", "", $matches[1])) : null;
        $matches = [];
        preg_match('/(\d+)\s*days,\s*(\d+)\s*hour\s*(\d+)\s*min/', $time_string, $matches);
        $days = $matches[1] ?? 0;
        $hours = $matches[2] ?? 0;
        $minutes = $matches[3] ?? 0;
        $uptime_as_minutes = ($days * 24 * 60) + ($hours * 60) + $minutes;

        $lines = explode("\n", $data);

        $parsed_data = [];

        foreach ($lines as $line) {

            if (preg_match('/^(.+)\s+(\d+\.\d+\s+ms)\s+([0-9.]+\%)\s+([0-9.]+\s+Mbps)\s+([0-9.]+\s+Mbps)\s+(.+)$/', $line, $matches)) {

                $dl_array = explode(" ", $matches[4]);
                $up_array = explode(" ", $matches[5]);

                $entry = [
                    'location' => trim($matches[1]),
                    'latency_ms' => (float)$matches[2],
                    'loss' => (float)$matches[3],
                    'dl_value' => (float)$dl_array[0],
                    'dl_unit' => $dl_array[1],
                    'up_value' => (float)$up_array[0],
                    'up_unit' => $up_array[1],
                    'server' => trim($matches[6]),
                ];

                // Add the entry to the parsed data array
                $parsed_data[] = $entry;
            } elseif (preg_match('/^(Avg DL Speed|Avg UL Speed|Total DL Data|Total UL Data|Total Data)\s+:\s+([0-9.]+\s+GB)/', $line, $matches)) {
                // Extract average speed and total data information
                $parsed_data[$matches[1]] = $matches[2];
            } elseif (preg_match('/^Duration\s+:\s+(\d+\s+min\s+\d+\s+sec)$/', $line, $matches)) {
                // Extract duration information
                $parsed_data['Duration'] = $matches[1];
            } elseif (preg_match('/^System Time\s+:\s+(.+)$/', $line, $matches)) {
                // Extract system time information
                $parsed_data['System Time'] = $matches[1];
            } elseif (preg_match('/^Total Script Runs\s+:\s+(\d+)$/', $line, $matches)) {
                // Extract total script runs information
                $parsed_data['Total Script Runs'] = $matches[1];
            }
        }

        preg_match('/Avg DL Speed\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $avgDlSpeedMatches);
        preg_match('/Avg UL Speed\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $avgUlSpeedMatches);
        preg_match('/Total DL Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalDlDataMatches);
        preg_match('/Total UL Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalUlDataMatches);
        preg_match('/Total Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalDataMatches);
        preg_match('/Duration\s+:\s+([0-9]+) min ([0-9]+) sec/', $data, $durationMatches);
        preg_match('/System Time\s+:\s+([0-9\/\:\s-]+)/', $data, $systemTimeMatches);
        preg_match('/Total Script Runs\s+:\s+([0-9]+)/', $data, $totalScriptRunsMatches);

        return $this->parsed = [
            'success' => true,
            'version' => $version,
            'region' => preg_replace('/[^A-Za-z\s]/', '', preg_match('/Region:\s+([^)]+)/', $data, $matches) ? trim($matches[1]) : null),
            'system_time' => \DateTime::createFromFormat('d/m/Y - H:i:s', trim($systemTimeMatches[1]))->format('Y-m-d H:i:s') ?: null,
            'total_script_runs' => (int)$totalScriptRunsMatches[1],
            'system' => [
                'cpu' => [
                    'model' => $cpu_model,
                    'base_freq' => $cpu_freq_stock,
                    'cores' => (int)$cpu_cores,
                    'freq' => (float)$cpu_frequency,
                ],
                'ram' => [
                    'value' => $ram_value,
                    'unit' => $ram_unit,
                    'used_value' => (float)$ramMatches[2],
                    'used_unit' => substr($ramMatches[2], -2)
                ],
                'swap' => [
                    'value' => $swap_value,
                    'unit' => $swap_unit,
                ],
                'disk' => [
                    'value' => $disk_value,
                    'unit' => $disk_unit,
                    'used_value' => (float)$diskMatches[2],
                    'used_unit' => substr($diskMatches[2], -2)
                ],
                'uptime_minutes' => $uptime_as_minutes,
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
            'results' => $parsed_data,
            'stats' => [
                'avg_dl_value' => (float)$avgDlSpeedMatches[1],
                'avg_dl_unit' => $avgDlSpeedMatches[2],
                'avg_up_value' => (float)$avgUlSpeedMatches[1],
                'avg_up_unit' => $avgUlSpeedMatches[2],
                'total_dl_value' => (float)$totalDlDataMatches[1],
                'total_dl_unit' => $totalDlDataMatches[2],
                'total_up_value' => (float)$totalUlDataMatches[1],
                'total_up_unit' => $totalUlDataMatches[2],
                'total_data_value' => (float)$totalDataMatches[1],
                'total_data_unit' => $totalDataMatches[2],
                'duration' => gmdate("H:i:s", ($durationMatches[1] * 60) + $durationMatches[2])
            ]
        ];
    }

    public function outputAsJson(): false|string
    {
        $data = $this->fetchRaw();

        if (!$data) {
            return json_encode(['success' => false, 'message' => 'Could not fetch valid results'], JSON_PRETTY_PRINT);
        }

        if ($this->isCompatibleVersion()) {

            try {
                return json_encode($this->asJson(), JSON_PRETTY_PRINT);
            } catch (\Exception $exception) {
                return json_encode(['success' => false, 'message' => 'Sorry there was an error parsing this'], JSON_PRETTY_PRINT);
            }

        }

        return json_encode(['success' => false, 'message' => 'This is an older incompatible version'], JSON_PRETTY_PRINT);
    }

    public function isCompatibleVersion(string $min_version = '2023.08.28', bool $must_match = false): bool
    {
        $data = $this->contents;

        preg_match('/Version\s*:\s*(.*?)\s/', $data, $matches);
        $version = str_replace("v", "", $matches[1]);

        if ($must_match) {
            return $version === $min_version;
        }

        if ($version >= $min_version) {
            return true;
        }

        return false;
    }

    public function convertKbpsToMbps(float $kbps, bool $format = false, int $decimals = 2): float
    {
        if (!$format) {
            return $kbps / 1000;
        }
        return (float)number_format($kbps / 1000, $decimals);
    }

    public function convertMbpsToGbps(float $mbps, bool $format = false, int $decimals = 2): float
    {
        if (!$format) {
            return $mbps / 1000;
        }
        return (float)number_format($mbps / 1000, $decimals);
    }

    public function convertGbpsToMbps(float $gbps, bool $format = false, int $decimals = 2): float
    {
        if (!$format) {
            return $gbps * 1000;
        }
        return (float)number_format($gbps * 1000, $decimals);
    }

    public function convertMbToGb(float $mb, bool $format = false, int $decimals = 2): float
    {
        if (!$format) {
            return $mb / 1000;
        }
        return (float)number_format($mb / 1000, $decimals);
    }

    public function convertGbToMb(float $gb, bool $format = false, int $decimals = 2): float
    {
        if (!$format) {
            return $gb * 1000;
        }
        return (float)number_format($gb * 1000, $decimals);
    }

    public function validateStorageUnit(string $unit): ?string
    {
        if ($unit === 'MB' || $unit === 'GB' || $unit === 'TB' || $unit === 'KB' || $unit === 'B') {
            return $unit;
        }
        return null;
    }

    public function validateSpeedUnit(string $unit): ?string
    {
        if ($unit === 'Mbps' || $unit === 'Gbps' || $unit === 'Kbps') {
            return $unit;
        }
        return null;
    }


}