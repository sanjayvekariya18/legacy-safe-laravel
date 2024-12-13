<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileManagerRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required||mimes:png,jpg,jpeg,svg|max:1024',
        ];
    }

}