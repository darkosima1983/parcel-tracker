<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Rules\UserTrucker;
class UpdateShipmentRequest extends FormRequest
{
 
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
            'details' => 'nullable|string',
            'user_id' => [
                'required',
               new UserTrucker(),
            ],
        ];
    }
}
