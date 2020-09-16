<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatchStudentID implements Rule
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
        $std_id = str_split($value);

        if ($std_id[5] == "3" && $std_id[6] == "3") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '學號錯誤';
    }
}
