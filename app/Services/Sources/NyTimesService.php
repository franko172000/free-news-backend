<?php

namespace App\Services\Sources;
use App\Contracts\NewsSourceHandler;
use App\Dto\NewsDto;
use App\Enums\NewsSources;
use App\Services\NewsAbstractApiService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class NyTimesService extends NewsAbstractApiService implements NewsSourceHandler
{
    protected string $baseUrl = 'https://api.nytimes.com/svc/search/v2/';

    /**
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function getNews(): array
    {
        $data = $this->httpClient()
            ->get('articlesearch.json', [
                'api-key' => $this->getApiKey(),
            ])->throw()
            ->json();

        $formatted = [];

        foreach ($data['response']['docs'] as $news){
            $formatted[] = new NewsDto(
                title: Arr::get($news,'headline.main'),
                content: Arr::get($news,'abstract', ''),
                url: Arr::get($news,'web_url'),
                imagePath: Arr::get($news,'multimedia.0.url'),
                category: Arr::get($news,'section_name'),
                publishedDate: Arr::get($news,'pub_date'),
                source: NewsSources::NY_TIMES->value
            );
        }
        return $formatted;
    }

    protected function getApiKey(): string {
        return config('services.news.ny-times');
    }
}
