<?php

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
