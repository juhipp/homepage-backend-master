<?php

namespace App\Services\Job;

use App\Models\JobCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryService
{
    public function create(array $attributes): JobCategory
    {
        $validated = Validator::make($attributes, [
            'title' => ['required', 'string', 'min:2'],
            'name' => ['required', 'string', Rule::unique('job_categories')]
        ])->validate();

        return DB::transaction(function () use ($validated) {
            return JobCategory::create([
                'title' => $validated['title'],
                'name' => $validated['name'],
            ]);
        });
    }

    public function update(JobCategory $jobCategory, array $attributes): JobCategory
    {
        $validated = Validator::make($attributes, [
            'title' => ['sometimes', 'string', 'min:2'],
            'name' => ['sometimes', 'string', Rule::unique('job_categories')]
        ])->validate();

        return DB::transaction(function () use ($validated, $jobCategory) {
            return JobCategory::create([
                'title' => $validated['title'] ?? $jobCategory->title,
                'name' => $validated['name'] ?? $jobCategory->name,
            ]);
        });
    }

    public function delete(JobCategory $jobCategory): void
    {
        DB::transaction(function () use ($jobCategory) {
            $jobCategory->delete();
        });
    }
}
