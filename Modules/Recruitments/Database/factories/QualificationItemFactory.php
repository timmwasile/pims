<?php

namespace Modules\Recruitments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Recruitments\Entities\QualificationItem;

class QualificationItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QualificationItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by'                => $this->faker->word,
            'qualification_category_id' => $this->faker->word,
            'title'                     => $this->faker->word,
            'description'               => $this->faker->word,
            'created_at'                => $this->faker->date('Y-m-d H:i:s'),
            'updated_at'                => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at'                => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
