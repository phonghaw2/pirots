<?php

use App\Enums\SystemCacheKeyEnum;
use App\Models\Category;

if(!function_exists('ArrayChildId')){
    function ArrayChildId($CategoryId): array
    {
        $categories = Category::with('children')->where('id', $CategoryId)->get()->map(function ($category) {
            $children = $category->childArray();
            unset($category->children);
            $category->children = $children;
            return $category->children;
        });
        return $categories->toArray();
    }

}

// if(!function_exists('getCategories')){
//     function getCategories(): array
//     {
//         return cache()->remember(
//             SystemCacheKeyEnum::CATEGORIES_PRODUCT,
//             86400 * 30,
//             function () {
//                 $categories = Category::query()->get();
//                 return $categories->toArray();
//             }
//         );
//     }

// }
if(!function_exists('getCategories')){
    function getCategories()
    {
        return cache()->remember(
            SystemCacheKeyEnum::CATEGORIES_PRODUCT,
            86400 * 30,
            function () {
                $categories = Category::whereNull('parent_id')
                            ->with('children')
                            ->get();
                return $categories;
            }
        );
    }

}



