<?php

namespace App\Services;

use App\Contracts\NewsContract;
use App\Dto\NewsDto;

class NewsService
{
    public function __construct(private readonly NewsContract $newsSource){
    }

    public function processNews()
    {
        $newContent = $this->newsSource->getNews();
        foreach ($newContent as $news){
            if($news instanceof NewsDto){
                //process
                $this->process($news);
            }
        }
    }

    public function process(NewsDto $news)
    {

    }
}
