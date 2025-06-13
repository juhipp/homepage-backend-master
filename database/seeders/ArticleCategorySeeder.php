<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            ArticleCategory::factory()->count(20)->create();
        });
    }
}
