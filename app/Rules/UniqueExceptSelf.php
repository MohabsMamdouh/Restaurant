<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueExceptSelf implements ValidationRule
{

    protected $model;
    protected $id;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this; // Maintain chainability
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->model)
            ->where('name', $value);

        if ($this->id) {
            $query->where('id', '<>', $this->id);
        }

        if ($query->exists()) {
            $fail('The name :attribute has already been taken.');
        }
    }
}
