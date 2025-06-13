<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersItems;
use App\Models\ArticleCategory;
use App\Services\Article\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ArticleCategory::class);
    }

    use FiltersItems;

    public function index(Request $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: [],
            query: ArticleCategory::query(),
        ));
    }

    public function store(
        Request         $request,
        CategoryService $service,
    )
    {
        try {
            $articleCategory = $service->create($request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($articleCategory);
    }

    public function show(ArticleCategory $articleCategory)
    {
        return response()->json($articleCategory);
    }

    public function update(
        Request         $request,
        ArticleCategory $articleCategory,
        CategoryService $service,
    )
    {
        try {
            $articleCategory = $service->update($articleCategory, $request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($articleCategory);
    }

    public function destroy(
        ArticleCategory $articleCategory,
        CategoryService $service,
    )
    {
        $service->delete($articleCategory);

        return response()->json(['message' => 'Article-Category deleted']);
    }
}
