<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatBroadCastRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => 'required|exists:documents,id',
            'message' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ];
    }
}
