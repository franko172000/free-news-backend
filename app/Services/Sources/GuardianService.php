<?php

namespace App\Services\Sources;

use App\Contracts\NewsContract;
use App\Dto\NewsDto;
use App\Enums\NewsSources;
use App\Services\NewsAbstractApiService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GuardianService extends NewsAbstractApiService implements NewsContract
{
    protected string $baseUrl = 'https://content.guardianapis.com/';

    /**
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function getNews(): array
    {
        $data = $this->httpClient()
            ->get('search', [
                'api-key' => $this->getApiKey(),
            ])->throw()
            ->json();

        $formatted = [];
        $articles = Arr::get($data, 'response.results', []);

        foreach ($articles as $article){
            $formatted[] = new NewsDto(
                title: Arr::get($article,'webTitle'),
                content: Arr::get($article,'webTitle'),
                url: Arr::get($article,'webUrl'),
                source: NewsSources::GUARDIAN->value,
                category: Arr::get($article,'sectionName'),
            );
        }
        return $formatted;
    }

    protected function getApiKey(): string {
        return config('services.news.guardian');
    }
}
