<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleService
{
    public function create(array $attributes): Article
    {
        return DB::transaction(function () {
            $content = Content::create(['title' => '', 'content' => '', 'meta_description' => '']);

            return Article::create([
                'active' => 0,
                'app_usage' => 0,
                'content_id' => $content->id,
                'user_id' => auth()->user()->id,
            ]);
        });
    }

    public function update(Article $article, array $attributes): Article
    {
        $validated = Validator::make($attributes, [
            'active' => ['sometimes', 'bool'],
            'app_usage'=> ['sometimes', 'bool'],
            'content' => ['sometimes', 'array'],
            'content.title' => ['nullable', 'string'],
            'content.content' => ['nullable', 'string'],
            'content.meta_description' => ['nullable', 'string'],
            'content.vorschau_text' => ['nullable', 'string'],
            'content.vorschauPic' => ['nullable', 'url'],
            'permapath' => ['sometimes', Rule::unique('articles', 'permapath')->ignore($article->id)],
        ])->validate();

        return DB::transaction(function () use ($validated, $article) {
            if (isset($validated['content'])) {
                $article->content->update($validated['content']);
            }

            $article->update([
                'active' => isset($validated['active']) ? ($validated['active'] ? 1 : 0) : $article->active,
                'app_usage' => isset($validated['app_usage']) ? ($validated['app_usage'] ? 1 : 0) : $article->app_usage,
                'permapath' => $validated['permapath'] ?? $article->permapath,
            ]);

            return $article;
        });
    }

    public function delete(Article $article): Article
    {
        return DB::transaction(function () use ($article) {
            $article->delete();

            return $article;
        });
    }

    public function restore(Article $article): Article
    {
        return DB::transaction(function () use ($article) {
            $article->restore();

            return $article;
        });
    }

    public function attachCategory(Article $article, ArticleCategory $articleCategory): void
    {
      DB::transaction(function () use ($article, $articleCategory) {
        $article->categories()->attach($articleCategory);
      });
    }

    public function detachCategory(Article $article, ArticleCategory $articleCategory): void
    {
      DB::transaction(function () use ($article, $articleCategory) {
        $article->categories()->detach($articleCategory);
      });
    }

}
