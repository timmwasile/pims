<?php

namespace Modules\Recruitments\Database\Factories;

use Modules\Recruitments\Entities\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_by'       => $this->faker->word,
            'job_category_id' => $this->faker->word,
            'job_level_id'    => $this->faker->word,
            'job_type_id'     => $this->faker->word,
            'approved_by'     => $this->faker->word,
            'title'           => $this->faker->word,
            'description'     => $this->faker->text,
            'gender'          => $this->faker->word,
            'start_date'      => $this->faker->date('Y-m-d H:i:s'),
            'end_date'        => $this->faker->date('Y-m-d H:i:s'),
            'approved_at'     => $this->faker->date('Y-m-d H:i:s'),
            'interview_date'  => $this->faker->date('Y-m-d H:i:s'),
            'created_at'      => $this->faker->date('Y-m-d H:i:s'),
            'updated_at'      => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at'      => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
