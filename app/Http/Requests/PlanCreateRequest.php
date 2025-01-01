<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'title'=>'required',
            'description'=>'required|max:100|',
            'currency'=>'required',
            'monthly_price' => 'required|numeric|min:1',
            'yearly_price' => 'required|numeric|min:1',
        ];
    }
}
