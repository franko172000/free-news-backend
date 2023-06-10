<?php

namespace App\Http\Controllers;

use App\Actions\ListNewsAction;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NewsController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = [];
        $searchTerm = Arr::get($request->input(), 'term');
        if($searchTerm){
            $data['term'] = $searchTerm;
        }
        if($request->user()){
            $data['user'] = $request->user();
        }
        $news  = ListNewsAction::run($data);
        return NewsResource::collection($news);
    }
}
