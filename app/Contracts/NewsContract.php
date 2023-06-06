<?php

namespace App\Contracts;

use App\Dto\NewsDto;

interface NewsContract
{
    public function getNews(): array;
}
