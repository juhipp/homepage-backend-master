<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersItems;
use App\Models\JobCategory;
use App\Services\Job\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(JobCategory::class);
    }

    use FiltersItems;

    public function index(Request $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: [],
            query: JobCategory::query(),
        ));
    }

    public function store(
        Request         $request,
        CategoryService $service,
    )
    {
        try {
            $jobCategory = $service->create($request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($jobCategory);
    }

    public function show(JobCategory $jobCategory)
    {
        return response()->json($jobCategory);
    }

    public function update(
        Request         $request,
        JobCategory     $jobCategory,
        CategoryService $service,
    )
    {
        try {
            $jobCategory = $service->update($jobCategory, $request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($jobCategory);
    }

    public function destroy(
        JobCategory     $jobCategory,
        CategoryService $service,
    )
    {
        $service->delete($jobCategory);

        return response()->json(['message' => 'Job-Category deleted']);
    }
}
