<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineStockRequest extends FormRequest
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
            'massVolumeType' => 'required|not_in:0',
            'medicineType' => 'required|not_in:0',
            'quantity' => 'required|max:191',
            'price' => 'required|max:191|numeric',
        ];
    }
}
