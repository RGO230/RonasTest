<?php

declare(strict_types=1);

namespace App\Services\Connectors;

use Illuminate\Support\Arr;

abstract class AbstractServiceConnector
{
    public function __construct(
        protected ?string $host = null,
    ) {}

        public function constructUrl(string $endpoint, ?array $query = null, ?array $replace = []): string
    {
        $url = $this->host;
        $endpoint .= $query ? '?' . Arr::query($query) : '';
        foreach ($replace as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', (string)$value, $endpoint);

        }

        return "{$url}{$endpoint}";
    }
}
