<?php

namespace Modules\Recruitments\Database\Factories;

use Modules\Recruitments\Entities\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'applicant_id'       => $this->faker->word,
            'job_post_id'        => $this->faker->word,
            'application_no'     => $this->faker->word,
            'cover_letter'       => $this->faker->text,
            'qualified_at'       => $this->faker->date('Y-m-d H:i:s'),
            'first_assessed_at'  => $this->faker->date('Y-m-d H:i:s'),
            'second_assessed_at' => $this->faker->date('Y-m-d H:i:s'),
            'third_assessed_at'  => $this->faker->date('Y-m-d H:i:s'),
            'interview_date'     => $this->faker->date('Y-m-d H:i:s'),
            'joining_date'       => $this->faker->date('Y-m-d H:i:s'),
            'created_at'         => $this->faker->date('Y-m-d H:i:s'),
            'updated_at'         => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at'         => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
