<?php

namespace Database\Factories;

use App\Models\CatBlog;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatBlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CatBlog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->word,
            'slug' => $this->faker->word,
        ];
    }
}
