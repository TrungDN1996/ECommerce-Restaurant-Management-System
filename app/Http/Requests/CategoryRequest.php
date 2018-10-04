<?php

namespace Lava\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:50',
            'description' =>'required|min:10',
            'type' => 'required',
            'parent_id' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.max' => 'The name may not be greater than 50 characters',
            'description.required' => 'The description is required',
            'description.min' =>'The description must be at least 10 characters',
            'type.required' => 'The type is required',
            'parent_id.integer' =>'The Category parent must be an integer'
        ];
    }
}
