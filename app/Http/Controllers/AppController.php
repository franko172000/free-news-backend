<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\Category;
use App\Models\News;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AppController extends Controller
{
    use ApiResponseTrait;
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->respondSuccess([
            'providers' => config('new-providers'),
            'categories' => Category::all()
        ]);
    }
}
