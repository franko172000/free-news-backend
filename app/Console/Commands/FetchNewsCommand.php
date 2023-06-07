<?php

namespace App\Console\Commands;

use App\Jobs\NewsJob;
use App\Services\Sources\GuardianService;
use App\Services\Sources\NewsApiService;
use App\Services\Sources\NyTimesService;
use Illuminate\Console\Command;

class FetchNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        collect([
            GuardianService::class,
            NewsApiService::class,
            NyTimesService::class,
        ])->each(function ($source){
            NewsJob::dispatch(new $source);
        });
    }
}
