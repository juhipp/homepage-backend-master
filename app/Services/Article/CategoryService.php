<?php

namespace App\Services\Article;

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryService
{
    public function create(array $attributes): ArticleCategory
    {
        $validated = Validator::make($attributes, [
            'title' => ['required', 'string', 'min:2'],
            'name' => ['required', 'string', Rule::unique('article_categories')]
        ])->validate();

        return DB::transaction(function () use ($validated) {
            return ArticleCategory::create([
                'title' => $validated['title'],
                'name' => $validated['name'],
            ]);
        });
    }

    public function update(ArticleCategory $articleCategory, array $attributes): ArticleCategory
    {
        $validated = Validator::make($attributes, [
            'title' => ['sometimes', 'string', 'min:2'],
            'name' => ['sometimes', 'string', Rule::unique('article_categories')]
        ])->validate();

        return DB::transaction(function () use ($validated, $articleCategory) {
            return ArticleCategory::create([
                'title' => $validated['title'] ?? $articleCategory->title,
                'name' => $validated['name'] ?? $articleCategory->name,
            ]);
        });
    }

    public function delete(ArticleCategory $articleCategory): void
    {
        DB::transaction(function () use ($articleCategory) {
            $articleCategory->delete();
        });
    }
}
