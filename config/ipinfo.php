<?php
return [
    'api_key' => env('IPINFO_API_KEY', 'da59153a673d57145d3cfc359a439723'),
    'host' => env ('IPINFO_HOST', 'https://api.ipinfo.info'),
    'get_info' => env('IPINFO_GET_INFO', "/api/?access_key={key}"),
    'mock_ip' => env("IPINFO_MOCK_IP", "5.101.227.0"),
];
