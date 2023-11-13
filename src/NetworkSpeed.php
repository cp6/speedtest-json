<?php

namespace Corbpie\NetworkSpeed;

class NetworkSpeed
{

    public string $id;


    public function __construct(string $id)
    {
        $this->id = $id;
    }
    
    public function fetchRaw(): bool|string
    {
        $url = "https://result.network-speed.xyz/r/{$this->id}.txt";

        $headers = array(
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0',
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'ERROR:' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }

}