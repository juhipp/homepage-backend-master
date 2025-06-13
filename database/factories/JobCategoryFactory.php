<?php

namespace Database\Factories;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobCategoryFactory extends Factory
{
    protected $model = JobCategory::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->word();

        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => ucfirst($title),
            'name' => $title,
        ];
    }
}
