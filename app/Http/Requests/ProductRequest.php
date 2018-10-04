<?php

namespace Lava\Http\Requests;

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
            'category_id' => 'required',
            'name' => 'required|max:50',
            'type' => 'required',
            'price' => 'required|integer|min:2',
            'status' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'This Category is required',
            'name.required' => 'This Name is required',
            'name.max' => 'The Name may not be greater than 50 characters',
            'type.required' => 'This Type is required ',
            'price.required' => 'This Price is required',
            'price.integer' => 'The Price must be an integer',
            'price.min' => 'The Price must be at least 2 numbers',
            'status.required' =>'The Status is required',
            'status.boolean' => 'The Status field must be 1 or 0'
        ];
    }
}
