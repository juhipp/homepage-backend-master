<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobFactory extends Factory
{
    protected $model = Job::class;

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
