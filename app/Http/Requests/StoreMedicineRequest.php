<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ];
    }
}

