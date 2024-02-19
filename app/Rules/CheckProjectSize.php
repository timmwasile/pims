<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;

class CheckProjectSize implements Rule
{
    protected $projectSize;
    protected $current_size;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($projectSize,$current_size)
    {
        $this->projectSize = $projectSize;
        $this->current_size = $current_size;

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
        $project_size = Project::where('id',$value)->first()->size;
        $total_taken_size = Plot::where('project_id', $value)->sum('size');
        return floatval(preg_replace("/[^-0-9\.]/","",$project_size)) >= floatval(preg_replace("/[^-0-9\.]/","",$total_taken_size)) + floatval(preg_replace("/[^-0-9\.]/","",$this->current_size)) ? true: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The entered plot size exceeding the remaining size " .$this->current_size. ". Please see the remaining project total Size " ;
    }
}
