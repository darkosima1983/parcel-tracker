<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewShipmentRequest extends FormRequest
{
   
    public function authorize(): bool
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
        return [
            'title' => 'required|string|max:128',
            'from_city' => 'required|string|max:64',
            'from_state' => 'required|string|max:256',
            'to_city' => 'required|string|max:64',
            'to_state' => 'required|string|max:256',
            'price' => 'required|integer',
            'status' => 'required|string|in:in_progress,unassigned,completed,problem',
            'user_id' => 'nullable|exists:users,id',
            'details' => 'nullable|string',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png,webp,jpeg|max:2048',
        ];
    }
}
