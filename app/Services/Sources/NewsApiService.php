<?php

namespace App\Services\Sources;

use App\Contracts\NewsContract;

class NewsApiService implements NewsContract
{
    public function getNews(): array
    {
        return [];
    }
}
