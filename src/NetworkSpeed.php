<?php

namespace Corbpie\NetworkSpeed;

class NetworkSpeed
{

    public string $filename;

    public string $contents;

    public array $parsed;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function fetchRaw(): bool|string
    {
        $headers = [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0',
        ];

        $ch = curl_init("https://result.network-speed.xyz/r/{$this->filename}.txt");
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
        $swap_value = (isset($matches[1])) ? (float)$matches[1] : null;
        $swap_unit = $matches[2] ?? null;

        preg_match('/Kernel\s*:\s*(.*?)\s/', $data, $matches);
        $kernel = $matches[1];

        preg_match('/Primary Network\s*:\s*(.*?)\s/', $data, $matches);
        $primaryNetwork = $matches[1];

        preg_match('/IPv6 Access\s*:\s*(.*?)\s/', $data, $matches);
        $ipv6Access = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/IPv4 Access\s*:\s*(.*?)\s/', $data, $matches);
        $ipv4Access = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/AES-NI\s*:\s*(.*?)\s/', $data, $matches);
        $aes = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/VM-x\/AMD-V\s*:\s*(.*?)\s/', $data, $matches);
        $vmx = (isset($matches[1])) ? $matches[1] === '✔' : null;

        preg_match('/Virtualization\s*:\s*(.*?)\s/', $data, $matches);
        $virtualization = $matches[1];

        preg_match('/Total Disk\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $diskMatches);
        preg_match('/Total RAM\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $ramMatches);
        preg_match('/Total Swap\s+:\s+([0-9.]+ [A-Z]+) \(([0-9.]+ [A-Z]+) Used\)/', $data, $swapMatches);
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

            if (preg_match('/^\s*([\w\s,]+)\s+(\d+\.\d+\s+ms)\s+(N\/A|\d+\.\d+\%)\s+(\d+\.\d+\s+Mbps)\s+(\d+\.\d+\s+Mbps)\s+(.+)\s*$/', $line, $matches)) {

                if (!isset($matches[3])) {
                    continue;
                }

                $dl_array = explode(" ", $matches[4]);
                $up_array = explode(" ", $matches[5]);

                $entry = [
                    'location' => trim($matches[1]),
                    'latency_ms' => (float)$matches[2],
                    'loss' => (float)$matches[3],
                    'dl_value' => (float)$dl_array[0],
                    'dl_unit' => $dl_array[1],
                    'dl_gbps' => ($dl_array[0] > 1000) ? $dl_array[0] / 1000 : null,
                    'up_value' => (float)$up_array[0],
                    'up_unit' => $up_array[1],
                    'up_gbps' => ($up_array[0] > 1000) ? $up_array[0] / 1000 : null,
                    'server' => trim($matches[6]),
                ];

                $parsed_data[] = $entry;
            } elseif (preg_match('/^(Avg DL Speed|Avg UL Speed|Total DL Data|Total UL Data|Total Data)\s+:\s+([0-9.]+\s+GB)/', $line, $matches)) {
                $parsed_data[$matches[1]] = $matches[2];
            } elseif (preg_match('/^Duration\s+:\s+(\d+\s+min\s+\d+\s+sec)$/', $line, $matches)) {
                $parsed_data['Duration'] = $matches[1];
            } elseif (preg_match('/^System Time\s+:\s+(.+)$/', $line, $matches)) {
                $parsed_data['System Time'] = $matches[1];
            } elseif (preg_match('/^Total Script Runs\s+:\s+(\d+)$/', $line, $matches)) {
                $parsed_data['Total Script Runs'] = $matches[1];
            }

        }

        preg_match('/Avg DL Speed\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $avgDlSpeedMatches);
        preg_match('/Avg UL Speed\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $avgUlSpeedMatches);
        preg_match('/Total DL Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalDlDataMatches);
        preg_match('/Total UL Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalUlDataMatches);
        preg_match('/Total Data\s+:\s+([0-9.]+) ([A-Za-z]+)/', $data, $totalDataMatches);
        preg_match('/Duration\s+:\s+(\d+) min (\d+) sec/', $data, $durationMatches);
        preg_match('/System Time\s+:\s+([0-9\/:\s-]+)/', $data, $systemTimeMatches);
        preg_match('/Total Script Runs\s+:\s+(\d+)/', $data, $totalScriptRunsMatches);

        return $this->parsed = [
            'success' => true,
            'id' => explode('_', $this->filename)[1] ?? null,
            'filename' => $this->filename,
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
                    'used_value' => (isset($swapMatches[2])) ? (float)$swapMatches[2] : null,
                    'used_unit' => (isset($swapMatches[2])) ? substr($swapMatches[2], -2) : null
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
                'aes' => $aes,
                'vmx' => $vmx,
                'virtualization' => $virtualization,
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
            'number_of_results' => count($parsed_data),
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
            ],
            'parsed_at' => date('Y-m-d H:i:s')
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
                return json_encode($this->asJson(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
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

}