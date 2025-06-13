<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersItems;
use App\Models\Job;
use App\Services\Job\JobService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Job::class);
    }

    use FiltersItems;

    public function index(Request $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: ['jobs'],
            query: Job::query(),
        ));
    }

    public function store(
        Request    $request,
        JobService $service,
    )
    {
        try {
            $job = $service->create($request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($job);
    }

    public function show(Job $job)
    {
        return response()->json($job);
    }

    public function update(
        Request    $request,
        Job        $job,
        JobService $service,
    )
    {
        try {
            $job = $service->update($job, $request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json($job);
    }

    public function destroy(
        Job        $job,
        JobService $service,
    )
    {
        $service->delete($job);

        return response()->json(['message' => 'Job deleted']);
    }

    public function restore(
        Job        $job,
        JobService $service,
    )
    {
        $this->authorize('update', $job);

        $service->restore($job);

        return response()->json($job);
    }
}
