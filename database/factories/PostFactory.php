<?php

namespace Database\Factories;

use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title' => $this->faker->title,
            'slug' => $this->faker->word,
            'subtitle' => $this->faker->text(100),
            'img' => 'xxx.jpg',
            'shortDescription' => $this->faker->text(255),
            'description' => $this->faker->realTextBetween(500 , 1000),
            'meta_description' => $this->faker->text(255),
            'seo_title' => $this->faker->title,
            'tags' => $this->faker->word,
            'visits' => rand(500 , 50000),
            'catBlog_id' => rand(1 , 10),
        ];
    }
}
