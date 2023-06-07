<?php

namespace App\Contracts;

interface NewsSourceHandler
{
    public function getNews(): array;
}
