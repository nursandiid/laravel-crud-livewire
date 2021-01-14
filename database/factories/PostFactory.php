<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title'       => $this->faker->name . Str::random(3),
            'slug'        => $this->faker->slug . Str::slug(Str::random(3)),
            'body'        => $this->faker->paragraph,
            'image'       => $this->faker->imageUrl(),
            'status'      => true,
            'is_approved' => true
        ];
    }
}
