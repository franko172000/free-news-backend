<?php

namespace App\Actions;

use App\Actions\Action;
use App\Models\News;
use Illuminate\Support\Arr;

class ListNewsAction extends Action
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user.id' => ['integer'],
            'term' => ['string'],
        ];
    }


    public function execute()
    {
        $news = News::orderBy('created_at','desc')
            ->with('category');

        $searchTerm = Arr::get($this->data, 'term');
        $user = Arr::get($this->data, 'user');

        if($searchTerm){
            $news = $news->where('title', 'LIKE', '%'.$searchTerm.'%');
        }

        if($user){
            $sources = Arr::get($user->preference, 'sources', []);
            $categories = Arr::get($user->preference, 'categories', []);
            if($sources){
                $news = $news->whereIn('source', $sources);
            }
            if($categories){
                $news = $news->whereIn('category_id', $categories);
            }
        }
        return $news->paginate(20);
    }
}
