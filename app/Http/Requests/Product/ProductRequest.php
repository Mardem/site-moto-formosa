<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'seo_description' => 'required|string|max:165',
            'description' => 'required|string',
            'category_product_id' => 'exists:category_products,id',
            'local' => 'numeric|digits_between:0,2',
            'price' => 'required'
        ];
    }
}
