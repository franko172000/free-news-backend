<?php

namespace App\Services\Sources;

use App\Contracts\NewsContract;

class GuardianService implements NewsContract
{

    public function getNews(): array
    {
        return [];
    }
}
