<?php

namespace Modules\Recruitments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Recruitments\Entities\QualificationCategory;

class QualificationCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QualificationCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by'  => $this->faker->word,
            'title'       => $this->faker->word,
            'description' => $this->faker->word,
            'created_at'  => $this->faker->date('Y-m-d H:i:s'),
            'updated_at'  => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at'  => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
