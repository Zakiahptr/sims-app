<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validation =
        [
            'category_id' => ['required', 'exists:categories,id'],
            'product_name' => ['required','string', 'unique:products,product_name'],
            'purchase_price' => ['required', 'numeric'],
            'selling_price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ];

    if ($this->isMethod('post')) {
        $validation['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2000'];
        $validation['product_name'] = ['required','string', 'unique:products,product_name'];
    }

    if (!$this->isMethod('post')) {
        $validation['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2000'];
        $validation['product_name'] = ['required','string'];
    }

    return $validation;
    }
}
