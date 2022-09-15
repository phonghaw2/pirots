<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use ResponseTrait;
    private object $model ;
    public function __construct()
    {
        $this->model = Product::query();
    }

    public function all(request $request)
    {
        $selectedStatus = $request->get('status');
        $selectedMainCate = $request->get('MainCate');
        $selectedSubCate = $request->get('SubCate');
        $selectedChildCate = $request->get('ChildCate');




        $query = $this->model->clone()
                ->with('category')
                ->latest();


        if(!empty($selectedStatus) && $selectedStatus !== 'All' || $selectedStatus == '0' ){
            $query->where('status', $selectedStatus);
        };

        if(!empty($selectedMainCate)){
            $category_arr = ArrayChildId($selectedMainCate);
            $query->whereIn('category_id', $category_arr[0]);
        };

        if(!empty($selectedSubCate)){
            $category_arr = ArrayChildId($selectedSubCate);
            $query->whereIn('category_id', $category_arr[0]);
        };

        if(!empty($selectedChildCate)){
            $query->where('category_id', $selectedChildCate);
        };


        $data = $query->paginate(10)
                ->appends($request->all());


        $status = ProductStatusEnum::asArray();
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.all',[
            'data' => $data,
            'status' => $status,
            'categories' => $categories,
            'selectedStatus' => $selectedStatus,
            'selectedMainCate' => $selectedMainCate,
        ]);
    }

    public function add()
    {
        return view('admin.products.add');
    }


    public function edit($productId)
    {
        $product = $this->model->with('category:id,name')->where('id', $productId)->first();
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request,$productId)
    {
        try {
            $arr = $request->validated();
            if($request->feature_image){
                $imageName = time() . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('img/products'), $imageName);
                $arr['feature_image'] = $imageName;
            }

            $product = Product::find($productId);
            $product->update($arr);
            return $this->successResponse();

        } catch (\Throwable $th) {

            return $this->errorResponse($th->getMessage());
        }

    }

    public function store(StoreProductRequest $request)
    {
        try {

            $imageName = time() . '.' . $request->feature_image->extension();
            $request->feature_image->move(public_path('img/products'), $imageName);
            $arr = $request->validated();
            $arr['feature_image'] = $imageName;
            Product::create($arr);
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    public function destroy($productId)
    {
        $product = Product::find($productId);
        $image_path = public_path('img/products/'. $product->feature_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->back();
    }
}
