<?php

namespace App\Services;

use App\Contracts\NewsSourceHandler;
use App\Dto\NewsDto;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class NewsService
{
    public function __construct(private readonly NewsSourceHandler $newsSource){
    }

    public function processNews(): void
    {
        $newContent = $this->newsSource->getNews();
        foreach ($newContent as $news){
            if($news instanceof NewsDto){
                //process
                $this->process($news);
            }
        }
    }

    protected function process(NewsDto $news): void
    {
        if($news->category){
            $categorySlug = Str::slug($news->category);
            $category = Category::updateOrCreate(
                [
                    'slug' => $categorySlug ],
                [
                    'name' => $news->category
                ]
            );
        }else{
            $category = Category::default()->first();
        }

        News::create([
            'category_id' => $category?->id,
            'title' => $news->title,
            'content' => $news->content,
            'featured_image' => $news->imagePath,
            'author' => $news->author,
            'source' => $news->source,
            'content_url' => $news->url,
        ]);
    }
}
