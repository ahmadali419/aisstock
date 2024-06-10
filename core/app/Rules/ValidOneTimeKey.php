<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User; // Adjust the model path as needed
use Illuminate\Support\Facades\Auth;

class ValidOneTimeKey implements Rule
{
    public function passes($attribute, $value)
    {
        $user_id = Auth::user()->id;
        // Check if the one_time_key exists in the users table
        return User::where(['id'=>$user_id,'on_time_key'=> $value])->exists();
    }

    public function message()
    {
        return 'The provided one-time key is invalid.';
    }
}
