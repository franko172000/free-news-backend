<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class NewsAbstractApiService extends BaseApiService
{
    protected string $baseUrl;

    abstract protected function getApiKey(): string;

    /**
     * @return string
     */
    protected function baseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return PendingRequest
     */
    protected function httpClient(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl());

    }
}
