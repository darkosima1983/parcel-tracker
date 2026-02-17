<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;

class UserClient implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isClient = User::where('id', $value)
            ->where('role', User::ROLE_CLIENT)
            ->exists();

        if (!$isClient) {
            $fail('Der ausgewählte Benutzer ist kein Kunde.');
        }
    }
}
