<?php

namespace App\Http\Requests;

use App\Enums\ProductStatusEnum;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'filled',
            ],
            'price' => [
                'required',
                'numeric',
                'filled',
            ],
            'feature_image' => [
                'required',
                'file',
                'image',
                'max:500',
            ],
            'color' => [
                'required',
                'string',
                'filled',
            ],
            'size' => [
                'required',
                'string',

            ],
            'category_id' => [
                'required',
            ],
            'description' => [
                'required',
                'string',
                'max:500',
            ],
            'status' => [
                'required',
                ValidationRule::in(ProductStatusEnum::getValues())
            ],
        ];
    }
}
