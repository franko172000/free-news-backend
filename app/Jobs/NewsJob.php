<?php

namespace App\Jobs;

use App\Contracts\NewsSourceHandler;
use App\Services\NewsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly NewsSourceHandler $newsSource){
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new NewsService($this->newsSource))->processNews();
    }
}
