<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $to;

    public function __construct($to)
    {
        $this->to = $to;
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
        return $value === $this->to;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Les deux mots de Passes ne sont pas conforme';
    }
}
