<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSlugRequest;
use App\Http\Requests\GenerateSlugRequest;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CateApiController extends Controller
{
    use ResponseTrait;
    private object $model;

    public function __construct()
    {
        $this->model = Category::query();
    }

    public function generateSlug(GenerateSlugRequest $request)
    {
        try {
            $makeSlug = $request->get('makeSlug');
            $typeCate = $request->get('typeCate');
            $slug = SlugService::createSlug(Category::class, 'slug' , $makeSlug);
            return $this->successResponse(['slug' => $slug , 'typeCate' => $typeCate]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }

    }
    public function checkSlug(CheckSlugRequest $request)
    {
        return $this->successResponse();

    }

    public function checkExists($CategoryName)
    {
        $check = $this->model->where('name', $CategoryName)
                    ->exists();
        return $this->successResponse($check);

    }
    public function categories(request $request)
    {
        $query = $this->model->clone();
        if($request->get('q')){
            $query->where('name', 'like' , '%' . $request->get('q') . '%')->get();
        }
        $parent_id = $request->get('parent_id');
        $data = $query->where('parent_id', $parent_id)->pluck('id', 'name');
        return $this->successResponse($data);

    }


    public function MainCategory(request $request)
    {
        $query = $this->model->clone();
        if($request->get('q')){
            $query->where('name', 'like' , '%' . $request->get('q') . '%')->get();
        }
        $data = $query->whereNull('parent_id')->pluck('id', 'name');
        return $this->successResponse($data);
    }
}
