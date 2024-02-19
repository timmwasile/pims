<?php

namespace Modules\Recruitments\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Salary;

class CheckIfSalaryIsCreated implements Rule
{
    protected $started_at;
    protected $ended_at;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ended_at, $started_at)
    {
        $this->started_at = $started_at;
        $this->ended_at = $ended_at;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = Salary::where('started_at',$value)->count();
        // dd($query);
        return $query == 0 ? true: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return "Salary already created." ;
    }
}