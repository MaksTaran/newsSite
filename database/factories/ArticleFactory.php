<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraphs(3, true),
            'preview_image' => 'preview.jpg', // или случайный: $this->faker->imageUrl()
            'full_image' => 'full.jpeg',
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}