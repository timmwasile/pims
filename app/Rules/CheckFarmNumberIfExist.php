<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Recruitments\Entities\FarmAsset;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;

class CheckFarmNumberIfExist implements Rule
{
    protected $map_number;
    protected $of_project_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($map_number,$of_project_id)
    {
        $this->map_number = $map_number;
        $this->of_project_id = $of_project_id;

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
        $number = FarmAsset::where('map_number', $value)->count();
        return $number == 0 ? true: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The entered farm number " .strtoupper($this->map_number). " has already taken or used" ;
    }
}
