# Network Speed XYZ to Json

A parser for https://network-speed.xyz/ which puts the speed test results and other information into formatted json data.

Working for versions `2023.08.28` through to `2023.11.13`

Tested on versions: `2023.08.28`, `2023.09.04`, `2023.09.22`, `2023.10.24` and `2023.11.13`.

All you need is the filename from the URL e.g `1699940146_TXQDAS_NA` is the filename from the URL below.

Example for https://result.network-speed.xyz/r/1699940146_TXQDAS_NA.txt
as json:

```json
{
  "success": true,
  "id": "TXQDAS",
  "version": "2023.11.13",
  "region": "NORTH AMERICA",
  "system_time": "2023-11-14 05:44:29",
  "total_script_runs": 27031,
  "system": {
    "cpu": {
      "model": "Intel(R) Xeon(R) CPU E5-2620 v3",
      "base_freq": 2.4,
      "cores": 2,
      "freq": 2399.996
    },
    "ram": {
      "value": 1.9,
      "unit": "GB",
      "used_value": 161.4,
      "used_unit": "MB"
    },
    "swap": {
      "value": 2.0,
      "unit": "GB"
    },
    "disk": {
      "value": 9.6,
      "unit": "TB",
      "used_value": 4.8,
      "used_unit": "TB"
    },
    "uptime_minutes": 273850,
    "load": "0.00, 0.00, 0.00",
    "os": "Ubuntu 18.04.5 LTS",
    "arch": "x86_64 (64 Bit)",
    "kernel": "4.15.0-210-generic",
    "virtualization": "KVM"
  },
  "network": {
    "primary_network": "IPv4",
    "ipv6_access": false,
    "ipv4_access": true,
    "isp": "HostHatch",
    "asn": "AS63473 HostHatch, LLC",
    "host": "Hatch LLC",
    "location": "Los Angeles, California-CA, United States"
  },
  "number_of_results": 30,
  "results": [
    {
      "location": "Nearest",
      "latency_ms": 0.35,
      "loss": 0,
      "dl_value": 10505.42,
      "dl_unit": "Mbps",
      "dl_gbps": 10.50542,
      "up_value": 14284.25,
      "up_unit": "Mbps",
      "up_gbps": 14.28425,
      "server": "Netprotect - Los Angeles, CA"
    },
    {
      "location": "Vancouver, BC",
      "latency_ms": 31.41,
      "loss": 0,
      "dl_value": 3359.29,
      "dl_unit": "Mbps",
      "dl_gbps": 3.35929,
      "up_value": 2454.39,
      "up_unit": "Mbps",
      "up_gbps": 2.45439,
      "server": "TELUS - Vancouver, BC"
    },
    {
      "location": "Calgary, AB",
      "latency_ms": 45.92,
      "loss": 0,
      "dl_value": 5641.17,
      "dl_unit": "Mbps",
      "dl_gbps": 5.64117,
      "up_value": 1641.65,
      "up_unit": "Mbps",
      "up_gbps": 1.64165,
      "server": "Shaw Communications - Calgary, AB"
    },
    {
      "location": "Winnipeg, MB",
      "latency_ms": 71.8,
      "loss": 0,
      "dl_value": 2767.32,
      "dl_unit": "Mbps",
      "dl_gbps": 2.7673200000000002,
      "up_value": 1155.54,
      "up_unit": "Mbps",
      "up_gbps": 1.15554,
      "server": "Voyageur Internet - Winnipeg, MB"
    },
    {
      "location": "Toronto, ON",
      "latency_ms": 59.98,
      "loss": 0,
      "dl_value": 7103.21,
      "dl_unit": "Mbps",
      "dl_gbps": 7.10321,
      "up_value": 1394.81,
      "up_unit": "Mbps",
      "up_gbps": 1.3948099999999999,
      "server": "Bell Canada - Toronto, ON"
    },
    {
      "location": "Montreal, QC",
      "latency_ms": 81.85,
      "loss": 0,
      "dl_value": 6375.79,
      "dl_unit": "Mbps",
      "dl_gbps": 6.37579,
      "up_value": 1181.09,
      "up_unit": "Mbps",
      "up_gbps": 1.18109,
      "server": "Rogers Wireless - Montr\u00e9al, QC"
    },
    {
      "location": "New York, NY",
      "latency_ms": 66.63,
      "loss": 0,
      "dl_value": 4120.09,
      "dl_unit": "Mbps",
      "dl_gbps": 4.12009,
      "up_value": 1273.9,
      "up_unit": "Mbps",
      "up_gbps": 1.2739,
      "server": "Surfshark Ltd - New York, NY"
    },
    {
      "location": "Ashburn, VA",
      "latency_ms": 67.19,
      "loss": 0,
      "dl_value": 3953.33,
      "dl_unit": "Mbps",
      "dl_gbps": 3.95333,
      "up_value": 984.47,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Rackdog - Ashburn, VA"
    },
    {
      "location": "Charlotte, NC",
      "latency_ms": 76.73,
      "loss": 0,
      "dl_value": 3732.32,
      "dl_unit": "Mbps",
      "dl_gbps": 3.73232,
      "up_value": 1341.39,
      "up_unit": "Mbps",
      "up_gbps": 1.34139,
      "server": "Windstream - Charlotte, NC"
    },
    {
      "location": "Atlanta, GA",
      "latency_ms": 64.93,
      "loss": 0,
      "dl_value": 6842.55,
      "dl_unit": "Mbps",
      "dl_gbps": 6.84255,
      "up_value": 1375.51,
      "up_unit": "Mbps",
      "up_gbps": 1.37551,
      "server": "i3D.net - Atlanta, GA"
    },
    {
      "location": "Miami, FL",
      "latency_ms": 60.82,
      "loss": 0,
      "dl_value": 1700.55,
      "dl_unit": "Mbps",
      "dl_gbps": 1.70055,
      "up_value": 1664.52,
      "up_unit": "Mbps",
      "up_gbps": 1.66452,
      "server": "AT&T - Miami, FL"
    },
    {
      "location": "Dallas, TX",
      "latency_ms": 42.53,
      "loss": 0,
      "dl_value": 1859.26,
      "dl_unit": "Mbps",
      "dl_gbps": 1.85926,
      "up_value": 1634.13,
      "up_unit": "Mbps",
      "up_gbps": 1.63413,
      "server": "Hivelocity - Dallas, TX"
    },
    {
      "location": "Houston, TX",
      "latency_ms": 38.45,
      "loss": 0,
      "dl_value": 2926.01,
      "dl_unit": "Mbps",
      "dl_gbps": 2.92601,
      "up_value": 872.17,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Ezee Fiber - Houston, TX"
    },
    {
      "location": "Kansas, MO",
      "latency_ms": 39.63,
      "loss": 0,
      "dl_value": 2117.11,
      "dl_unit": "Mbps",
      "dl_gbps": 2.1171100000000003,
      "up_value": 1511.04,
      "up_unit": "Mbps",
      "up_gbps": 1.51104,
      "server": "Xiber LLC - Kansas City, MO"
    },
    {
      "location": "Minneapolis, MN",
      "latency_ms": 57.22,
      "loss": 0,
      "dl_value": 6986.95,
      "dl_unit": "Mbps",
      "dl_gbps": 6.98695,
      "up_value": 652.98,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "US Internet - Minneapolis, MN"
    },
    {
      "location": "Chicago, IL",
      "latency_ms": 56.74,
      "loss": 0,
      "dl_value": 2427.47,
      "dl_unit": "Mbps",
      "dl_gbps": 2.42747,
      "up_value": 1415.28,
      "up_unit": "Mbps",
      "up_gbps": 1.4152799999999999,
      "server": "Enzu.com - Chicago, IL"
    },
    {
      "location": "Cleveland, OH",
      "latency_ms": 65.94,
      "loss": 0,
      "dl_value": 2583.59,
      "dl_unit": "Mbps",
      "dl_gbps": 2.58359,
      "up_value": 1589.11,
      "up_unit": "Mbps",
      "up_gbps": 1.5891099999999998,
      "server": "Windstream - Cleveland, OH"
    },
    {
      "location": "Albuquerque, NM",
      "latency_ms": 31.12,
      "loss": 0,
      "dl_value": 5002.65,
      "dl_unit": "Mbps",
      "dl_gbps": 5.00265,
      "up_value": 2666.01,
      "up_unit": "Mbps",
      "up_gbps": 2.6660100000000004,
      "server": "Comcast - Albuquerque, NM"
    },
    {
      "location": "Denver, CO",
      "latency_ms": 28.22,
      "loss": 0,
      "dl_value": 4482.38,
      "dl_unit": "Mbps",
      "dl_gbps": 4.48238,
      "up_value": 1371.49,
      "up_unit": "Mbps",
      "up_gbps": 1.37149,
      "server": "T-Mobile Fiber | Intrepid - Denver, CO"
    },
    {
      "location": "Portland, OR",
      "latency_ms": 24.2,
      "loss": 0,
      "dl_value": 3138.74,
      "dl_unit": "Mbps",
      "dl_gbps": 3.13874,
      "up_value": 4270.26,
      "up_unit": "Mbps",
      "up_gbps": 4.27026,
      "server": "CenturyLink - Portland, OR"
    },
    {
      "location": "Las Vegas, NV",
      "latency_ms": 6.41,
      "loss": 0,
      "dl_value": 7942.53,
      "dl_unit": "Mbps",
      "dl_gbps": 7.94253,
      "up_value": 9136.67,
      "up_unit": "Mbps",
      "up_gbps": 9.13667,
      "server": "Dish Wireless - Las Vegas, NV"
    },
    {
      "location": "Salt Lake, UT",
      "latency_ms": 19.14,
      "loss": 0,
      "dl_value": 1928.04,
      "dl_unit": "Mbps",
      "dl_gbps": 1.92804,
      "up_value": 2517.05,
      "up_unit": "Mbps",
      "up_gbps": 2.5170500000000002,
      "server": "Novva Data Centers - Salt Lake City, UT"
    },
    {
      "location": "Phoenix, AZ",
      "latency_ms": 11.82,
      "loss": 0,
      "dl_value": 3164.97,
      "dl_unit": "Mbps",
      "dl_gbps": 3.16497,
      "up_value": 7757.29,
      "up_unit": "Mbps",
      "up_gbps": 7.75729,
      "server": "Xiber LLC - Phoenix, AZ"
    },
    {
      "location": "Los Angeles, CA",
      "latency_ms": 0.46,
      "loss": 0,
      "dl_value": 7386.78,
      "dl_unit": "Mbps",
      "dl_gbps": 7.38678,
      "up_value": 8990.51,
      "up_unit": "Mbps",
      "up_gbps": 8.99051,
      "server": "ReliableSite Hosting - Los Angeles, CA"
    },
    {
      "location": "San Jose, CA",
      "latency_ms": 13.24,
      "loss": 0,
      "dl_value": 3956.03,
      "dl_unit": "Mbps",
      "dl_gbps": 3.95603,
      "up_value": 4540.33,
      "up_unit": "Mbps",
      "up_gbps": 4.54033,
      "server": "Misaka Network, Inc. - San Jose, CA"
    },
    {
      "location": "Seattle, WA",
      "latency_ms": 30.61,
      "loss": 0,
      "dl_value": 5047.1,
      "dl_unit": "Mbps",
      "dl_gbps": 5.0471,
      "up_value": 2911.91,
      "up_unit": "Mbps",
      "up_gbps": 2.9119099999999998,
      "server": "Misaka Network, Inc. - Seattle, WA"
    },
    {
      "location": "Anchorage, AK",
      "latency_ms": 75.97,
      "loss": 0,
      "dl_value": 2200.36,
      "dl_unit": "Mbps",
      "dl_gbps": 2.2003600000000003,
      "up_value": 271.04,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "Alaska Communications - Anchorage, AK"
    },
    {
      "location": "Hermosillo, MX",
      "latency_ms": 32.97,
      "loss": 0,
      "dl_value": 4100.18,
      "dl_unit": "Mbps",
      "dl_gbps": 4.10018,
      "up_value": 2644.22,
      "up_unit": "Mbps",
      "up_gbps": 2.64422,
      "server": "Megacable - Hermosillo"
    },
    {
      "location": "Guadalajara, MX",
      "latency_ms": 58.48,
      "loss": 0,
      "dl_value": 1672.99,
      "dl_unit": "Mbps",
      "dl_gbps": 1.67299,
      "up_value": 718.78,
      "up_unit": "Mbps",
      "up_gbps": null,
      "server": "AT&T M\u00e9xico - Guadalajara"
    },
    {
      "location": "Mexico City, MX",
      "latency_ms": 42.14,
      "loss": 0,
      "dl_value": 4501.56,
      "dl_unit": "Mbps",
      "dl_gbps": 4.5015600000000004,
      "up_value": 1021.99,
      "up_unit": "Mbps",
      "up_gbps": 1.02199,
      "server": "INFINITUM - Mexico City"
    }
  ],
  "stats": {
    "avg_dl_value": 4317.53,
    "avg_dl_unit": "Mbps",
    "avg_up_value": 2841.46,
    "avg_up_unit": "Mbps",
    "total_dl_value": 161,
    "total_dl_unit": "GB",
    "total_up_value": 108.77,
    "total_up_unit": "GB",
    "total_data_value": 269.77,
    "total_data_unit": "GB",
    "duration": "00:13:13"
  }
}
 ```