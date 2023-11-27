# Network Speed XYZ to Json

A parser for Linux server network benchmarking script https://network-speed.xyz/ to put the speed test results and other information into formatted json data.

Working for versions `2023.08.28` through to `2023.11.13`

Tested on the versions: `2023.08.28`, `2023.09.04`, `2023.09.22`, `2023.10.24` and `2023.11.13`.

All you need is the filename from the URL. e.g `1699940146_TXQDAS_NA` is the filename from the URL below.

Install with:

`composer require corbpie/networkspeed-json`


Usage example:

```php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\NetworkSpeed;

$ns = new NetworkSpeed\NetworkSpeed("1700542086_ELGGKB_GLOBAL");

echo $ns->outputAsJson();
```

Example for https://result.network-speed.xyz/r/1700542086_ELGGKB_GLOBAL.txt
as JSON:

```json
{
  "id": "ELGGKB",
  "filename": "1700542086_ELGGKB_GLOBAL",
  "version": "2023.11.13",
  "region": "GLOBAL",
  "system_time": "2023-11-21 04:57:48",
  "total_script_runs": 27570,
  "system": {
    "cpu": {
      "model": "Intel(R) Xeon(R) CPU E3-1270 v3",
      "base_freq": 3.5,
      "cores": 8,
      "freq": 2609.896
    },
    "ram": {
      "value": 31.3,
      "unit": "GB",
      "used_value": 1.1,
      "used_unit": "GB"
    },
    "swap": {
      "value": 2,
      "unit": "GB",
      "used_value": null,
      "used_unit": null
    },
    "disk": {
      "value": 438.1,
      "unit": "GB",
      "used_value": 14.8,
      "used_unit": "GB"
    },
    "uptime_minutes": 114913,
    "load": "0.69, 0.22, 0.13",
    "os": "Ubuntu 20.04.6 LTS",
    "arch": "x86_64 (64 Bit)",
    "kernel": "5.4.0-159-generic",
    "aes": true,
    "vmx": true,
    "virtualization": "NONE"
  },
  "network": {
    "primary_network": "IPv4",
    "ipv6_access": false,
    "ipv4_access": true,
    "isp": "Shock Hosting LLC",
    "asn": "AS395092 Shock Hosting LLC",
    "host": "Shock",
    "location": "Sydney, New South Wales-NSW, Australia"
  },
  "number_of_results": 25,
  "results": [
    {
      "location": "Nearest",
      "latency_ms": 0.15,
      "loss": 0,
      "dl_value": 943.03,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 941.35,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "TasmaNet Pty Ltd - Sydney"
    },
    {
      "location": "Kochi, IN",
      "latency_ms": 185.34,
      "loss": 0,
      "dl_value": 593.18,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 591.29,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Asianet Broadband - Cochin"
    },
    {
      "location": "Bangalore, IN",
      "latency_ms": 129.17,
      "loss": 0,
      "dl_value": 824.23,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 519.72,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Bharti Airtel Ltd - Bangalore"
    },
    {
      "location": "Chennai, IN",
      "latency_ms": 128.23,
      "loss": 0,
      "dl_value": 864.27,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 639.1,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Jio - Chennai"
    },
    {
      "location": "Mumbai, IN",
      "latency_ms": 195.87,
      "loss": 0,
      "dl_value": 774.75,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 338.06,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "i3D.net - Mumbai"
    },
    {
      "location": "Delhi, IN",
      "latency_ms": 217.19,
      "loss": 0,
      "dl_value": 473.76,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 203.84,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Tata Teleservices Ltd - New Delhi"
    },
    {
      "location": "Seattle, US",
      "latency_ms": 145.75,
      "loss": 0,
      "dl_value": 683.53,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 625.41,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Comcast - Seattle, WA"
    },
    {
      "location": "Los Angeles, US",
      "latency_ms": 208.24,
      "loss": 5.2,
      "dl_value": 661.21,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 2.01,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "ReliableSite Hosting - Los Angeles, CA"
    },
    {
      "location": "Dallas, US",
      "latency_ms": 205.07,
      "loss": 0,
      "dl_value": 692.69,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 451.04,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Hivelocity - Dallas, TX"
    },
    {
      "location": "Miami, US",
      "latency_ms": 218.8,
      "loss": 0,
      "dl_value": 593.67,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 408.41,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "AT&T - Miami, FL"
    },
    {
      "location": "New York, US",
      "latency_ms": 270.14,
      "loss": 0,
      "dl_value": 864.73,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 334.81,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "GSL Networks - New York, NY"
    },
    {
      "location": "Toronto, CA",
      "latency_ms": 202.64,
      "loss": 0,
      "dl_value": 497.2,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 436.42,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Rogers - Toronto, ON"
    },
    {
      "location": "London, UK",
      "latency_ms": 260.81,
      "loss": 5,
      "dl_value": 843.43,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 1.1,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "VeloxServ Communications - London"
    },
    {
      "location": "Amsterdam, NL",
      "latency_ms": 279.18,
      "loss": 0,
      "dl_value": 826.78,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 306,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "31173 Services AB - Amsterdam"
    },
    {
      "location": "Paris, FR",
      "latency_ms": 294.24,
      "loss": 0,
      "dl_value": 816.66,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 49.26,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Axione - Paris"
    },
    {
      "location": "Frankfurt, DE",
      "latency_ms": 289.2,
      "loss": 0,
      "dl_value": 476.1,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 320.7,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "23M GmbH - Frankfurt am Main"
    },
    {
      "location": "Warsaw, PL",
      "latency_ms": 320.96,
      "loss": 0,
      "dl_value": 535.33,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 279.37,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "UPC Polska - Warszawa"
    },
    {
      "location": "Bucharest, RO",
      "latency_ms": 288.54,
      "loss": 5,
      "dl_value": 575.83,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 1.17,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Vodafone Romania Fixed \u2013 Bucharest - Bucharest"
    },
    {
      "location": "Jeddah, SA",
      "latency_ms": 189.12,
      "loss": 5.3,
      "dl_value": 893.14,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 1.94,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Saudi Telecom Company"
    },
    {
      "location": "Dubai, AE",
      "latency_ms": 292.23,
      "loss": 0,
      "dl_value": 536.04,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 313.8,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "du - Dubai"
    },
    {
      "location": "Fujairah, AE",
      "latency_ms": 261.86,
      "loss": 5,
      "dl_value": 799.68,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 1.35,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "ETISALAT-UAE - Fujairah"
    },
    {
      "location": "Tokyo, JP",
      "latency_ms": 98.64,
      "loss": 0,
      "dl_value": 731.21,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 859.7,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "fdcservers.net - Tokyo"
    },
    {
      "location": "Hong Kong, CN",
      "latency_ms": 120.89,
      "loss": 0,
      "dl_value": 751.26,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 1.81,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "STC - Hong Kong"
    },
    {
      "location": "Singapore, SG",
      "latency_ms": 92.91,
      "loss": 0,
      "dl_value": 919.14,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 876.48,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "i3D.net - Singapore"
    },
    {
      "location": "Jakarta, ID",
      "latency_ms": 109.26,
      "loss": 5,
      "dl_value": 805.07,
      "dl_unit": "Mbps",
      "dl_gbps": null,
      "up_value": 3.1,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "PT. Telekomunikasi Indonesia - Jakarta"
    }
  ],
  "stats": {
    "avg_dl_value": 710.24,
    "avg_dl_unit": "Mbps",
    "avg_up_value": 326.5,
    "avg_up_unit": "Mbps",
    "total_dl_value": 26.44,
    "total_dl_unit": "GB",
    "total_up_value": 11.44,
    "total_up_unit": "GB",
    "total_data_value": 37.88,
    "total_data_unit": "GB",
    "duration": "00:14:47"
  },
  "parsed_at": "2023-11-27 12:08:25"
}
 ```
