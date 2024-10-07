<?php

namespace App\Services\IpInfo\Contracts;

use Illuminate\Support\Collection;

interface IpInfoContract
{
    public function getInfo(string $ip) : string|Collection|null;
}
