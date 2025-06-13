<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        /** @var Content $content */
        $content = Content::factory()->createOne();
        $user = User::first();

        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'active' => $this->faker->randomElement([0, 1]),

            'user_id' => $user->id,
            'content_id' => $content->id
        ];
    }
}
