<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateBetween implements ValidationRule
{

     /**
     * The minimum allowed date.
     *
     * @var string|null
     */
    public $min;

    /**
     * The maximum allowed date.
     *
     * @var string|null
     */
    public $max;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->min = now();
        $this->max = now()->addWeek();
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail) :void
    {
        try {
            $date = \Carbon\Carbon::parse($value);

            if ($date->lt($this->min)) {
                $fail('The reservation date must be after today.'); // Adjusted message
            }

            if ($date->gt($this->max)) {
                $fail('The reservation date must be within one week of today.'); // Adjusted message
            }
        } catch (\Exception $e) {
            $fail('The reservation date is not a valid date.');
        }
    }
}
