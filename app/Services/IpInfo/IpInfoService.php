<?php

namespace App\Services\IpInfo;

use App\Services\Connectors\IpInfoConnector;
use App\Services\IpInfo\Contracts\IpInfoContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IpInfoService implements IpInfoContract
{
    private string $apiKey;

    public function __construct(private IpInfoConnector $connector)
    {
        $this->apiKey = config('ipinfo.api_key');
    }

    public function getInfo(string $ip) : string|Collection|null
    {
            $query = ['access_key' => $this->apiKey];

            $response = Http::get(
                $this->connector->constructUrl(str_replace('{ip}',"{$ip}",config('ipinfo.get_info'))),
                $query,
            );
            if ($response->ok() && isset($response['city'])) {
                return $response['city'];
            }
        return collect(['message' => 'Invalid response', 'status' => $response->status()]);
}
}
