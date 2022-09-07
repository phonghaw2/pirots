<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use ResponseTrait;

    public function add()
    {
        $categories = Category::query()->get();
        return view('admin.categories.add', compact('categories'));
    }

    public function edit()
    {
        $categories = Category::whereNull('parent_id')
                                ->with('children')
                                ->get();
        return view('admin.categories.edit', compact('categories'));
    }

    public function addMain(request $request)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    'max:25',
                ],
                'slug' => [
                    'required',
                    // 'max:25',
                ],
            ]);
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }

    }
    public function addSub(request $request)
    {
        try {
            $request->validate([
                'mainCateId' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'max:25',
                ],
                'slug' => [
                    'required',
                ],
            ]);
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->mainCateId,
            ]);

            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }

    }
    public function addChild(request $request)
    {
        try {
            $request->validate([
                'subCateID' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'max:25',
                ],
                'slug' => [
                    'required',
                ],
            ]);
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->subCateID,
            ]);

            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }

    }

    public function updateCategory(request $request)
    {
        try {
            $request->validate([
                'id' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'max:25',
                ],
                'slug' => [
                    'required',
                ],
            ]);
            Category::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'slug' => $request->slug,
                    ])
            ;

            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
