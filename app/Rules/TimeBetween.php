<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeBetween implements ValidationRule
{
    /**
     * The minimum allowed time (hour:minute).
     *
     * @var string
     */
    public $min;

    /**
     * The maximum allowed time (hour:minute).
     *
     * @var string
     */
    public $max;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->min = Carbon::createFromTimeString("17:00:00");
        $this->max = Carbon::createFromTimeString("23:00:00");
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $pickupDate = Carbon::parse($value);
            $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);


            if (!$pickupTime->between($this->min, $this->max)) {
                $fail('The Reservation Time must be between 17:00 PM and 23:00 AM.');
            }
        } catch (\Exception $e) {
            $fail('The Reservation Time is not a valid time.');
        }
    }
}
