<?php

namespace App\Services\Sources;
use App\Contracts\NewsContract;

class NyTimesService implements NewsContract
{

    public function getNews(): array
    {
        return [];
    }
}
