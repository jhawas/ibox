<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomsRequest extends FormRequest
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
            'code' => 'required|max:191',
            'description' => 'required|max:191',
            'floor' => 'required|not_in:0',
            'roomType' => 'required|not_in:0',
            'capacity' => 'required|max:191|not_in:0',
            'price' => 'required|max:191|numeric',
        ];
    }
}
