<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MatchAccount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !(DB::table('users')->where('account', $value)->get()->isEmpty());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '找不到此帳號';
    }
}
