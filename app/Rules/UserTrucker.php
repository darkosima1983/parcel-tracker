<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
class UserTrucker implements ValidationRule
{
   
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isTrucker = User::where('id', $value)->where('role', User::ROLE_TRUCKER)->exists();
        if (!$isTrucker) {
            $fail('Der ausgewählte Benutzer ist kein Fahrer.');
        }
    }
}
