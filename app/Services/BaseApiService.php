<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;

abstract class BaseApiService
{
    /**
     * @return string
     */
    abstract protected function baseUrl(): string;

    /**
     * @return PendingRequest
     */
    abstract protected function httpClient(): PendingRequest;

    /**
     * @param string $url
     * @param array  $endpointParameters
     *
     * @return string
     */
    protected function url(string $url, array $endpointParameters = []): string
    {
        if (!empty($endpointParameters)) {
            //$url = Arr::query($endpointParameters);
            $url = url($url, Arr::query($endpointParameters));
        }

        return $url;
    }
}
