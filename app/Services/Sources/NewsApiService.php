<?php

namespace App\Services\Sources;

use App\Contracts\NewsSourceHandler;
use App\Dto\NewsDto;
use App\Enums\NewsSources;
use App\Services\NewsAbstractApiService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class NewsApiService extends NewsAbstractApiService implements NewsSourceHandler
{
    protected string $baseUrl = 'https://newsapi.org/v2/';

    /**
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function getNews(): array
    {
        $data = $this->httpClient()
            ->get('top-headlines', [
                'apikey' => $this->getApiKey(),
                'country' => 'us',
            ])->throw()
            ->json();

        $formatted = [];
        $articles = Arr::get($data, 'articles', []);

        foreach ($articles as $article){
            $formatted[] = new NewsDto(
                title: Arr::get($article,'title'),
                content: Arr::get($article,'description'),
                url: Arr::get($article,'url'),
                imagePath: Arr::get($article,'urlToImage'),
                source: NewsSources::NEWS_API->value,
                author: Arr::get($article,'author'),
                publishedDate: Arr::get($article,'publishedAt')
            );
        }
        return $formatted;
    }

    protected function getApiKey(): string {
        return config('services.news.news-api');
    }
}
