<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersItems;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\Article\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class);
    }

    use FiltersItems;

    public function index(Request $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: ['articles'],
            query: Article::query(),
        ));
    }

    public function store(
        Request        $request,
        ArticleService $service,
    )
    {
        try {
            $article = $service->create($request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($article);
    }

    public function show(Article $article)
    {
        return response()->json($article);
    }

    public function update(
        Request        $request,
        Article        $article,
        ArticleService $service,
    )
    {
        try {
            $article = $service->update($article, $request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($article);
    }

    public function destroy(
        Article        $article,
        ArticleService $service,
    )
    {
        $service->delete($article);

        return response()->json(['message' => 'Article deleted']);
    }

    public function restore(
        Article        $article,
        ArticleService $service,
    )
    {
        $this->authorize('update', $article);

        $service->restore($article);

        return response()->json($article);
    }

    public function attachCategory(
        Article         $article,
        ArticleCategory $articleCategory,
        ArticleService  $service,
    ) 
    {
        $this->authorize('update', $article);

        $service->attachCategory($article, $articleCategory);

        return response()->json($article);
    }

    public function detachCategory(
        Article         $article,
        ArticleCategory $articleCategory,
        ArticleService  $service,
    ) 
    {
        $this->authorize('update', $article);

        $service->detachCategory($article, $articleCategory);

        return response()->json($article);
    }
}
