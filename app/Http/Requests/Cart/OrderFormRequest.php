<?php

namespace Lava\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'user_id' => 'required',
            'ship' => 'required',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    /**
     * Get the validation messages for rules
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'User ID must be enter',
            'ship.required' => 'Ship must be enter',
            'date.required' => 'Date must be enter',
            'time.required' => 'Time must be enter',
        ];
    }
}
