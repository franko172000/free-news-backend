<?php

namespace App\Enums;

enum NewsSources: string
{
   case NY_TIMES = 'ny-times';
   case GUARDIAN = 'guardian';
   case NEWS_API = 'news-api';
}
