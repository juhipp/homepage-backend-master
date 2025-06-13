<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            JobCategory::factory()->count(20)->create();
        });
    }
}
