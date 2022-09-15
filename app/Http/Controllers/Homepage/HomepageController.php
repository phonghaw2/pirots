<?php

namespace App\Http\Controllers\Homepage;

use App\Enums\SystemCacheKeyEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        // cache()->forget(SystemCacheKeyEnum::CATEGORIES_PRODUCT);
        $categories = getCategories();
        return view('homepage.homepage',[
            'categories' => $categories,
        ]);
    }
}
