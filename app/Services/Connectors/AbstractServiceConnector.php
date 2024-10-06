<?php

declare(strict_types=1);

namespace App\Services\Connectors;

use Illuminate\Support\Arr;

abstract class AbstractServiceConnector
{
    public function __construct(
        protected string $scheme,
        protected string $host,
        protected ?string $port = null,
    ) {}

    public function constructUrl(string $endpoint, ?array $query = null, ?array $replace = []): string
    {
        $url = "{$this->scheme}://{$this->host}";
        $url .= $this->port ? ":{$this->port}" : '';
        $endpoint .= $query ? '?' . Arr::query($query) : '';

        foreach ($replace as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', (string)$value, $endpoint);
        }

        return "{$url}{$endpoint}";
    }
}
