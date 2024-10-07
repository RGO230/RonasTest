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

    public function getInfo(string $ip) :string|Collection
    {
            $query = ['access_key' => $this->apiKey];
        try {
            $response = Http::get(
                $this->connector->constructUrl(str_replace('{ip}',"{$ip}",config('ipinfo.get_info'))),
                $query,
            );
            if($response->ok()) {
                return $response['city'];
            }
        }catch (\Exception $error){
            return collect(response()->json(['message'=>$error->getMessage(),'status'=>$error->getCode()]));
        }
        return collect();
    }
}
