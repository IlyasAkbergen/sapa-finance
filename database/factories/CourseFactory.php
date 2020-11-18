<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, 2),
            'short_description' => $this->faker->sentence,
            'is_online' => $this->faker->boolean,
            'price_with_feedback' => $this->faker->numberBetween(10000, 120000),
            'price_without_feedback' => $this->faker->numberBetween(10000, 120000),
            'direct_fee' => $this->faker->numberBetween(1000, 5000),
            'awardable' => $this->faker->boolean,
        ];
    }
}
