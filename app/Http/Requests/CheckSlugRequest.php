<?php

namespace App\Http\Requests;


use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class CheckSlugRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'filled',
                ValidationRule::unique(Category::class),
            ]
        ];
    }
    public function messages()
{
    return [
        'slug.unique' => 'Duplicate a slug',

    ];
}
}
