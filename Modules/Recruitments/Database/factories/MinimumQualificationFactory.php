<?php

namespace Modules\Recruitments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Recruitments\Entities\MinimumQualification;

class MinimumQualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MinimumQualification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'defined_by'          => $this->faker->word,
            'job_post_id'         => $this->faker->word,
            'education_level_id'  => $this->faker->word,
            'job_level_id'        => $this->faker->word,
            'skill_id'            => $this->faker->word,
            'skill_level_id'      => $this->faker->word,
            'years_of_experience' => $this->faker->word,
            'age'                 => $this->faker->word,
            'created_at'          => $this->faker->date('Y-m-d H:i:s'),
            'updated_at'          => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at'          => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
