<?php

namespace App\Rules;

use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;

class MAX_POST_ALLOWED implements Rule
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
        return !(Post::where($attribute, $value)->count() >= 3) ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User has Exceeded max posts allowed which is 3 posts';
    }
}
