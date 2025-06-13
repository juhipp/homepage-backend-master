<?php

namespace App\Services\Job;

use App\Models\Content;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobService
{
    public function create(array $attributes): Job
    {
        return DB::transaction(function () {
            $content = Content::create(['title' => '', 'content' => '', 'meta_description' => '']);

            return Job::create([
                'active' => 0,
                'content_id' => $content->id,
                'user_id' => auth()->user()->id,
            ]);
        });
    }

    public function update(Job $job, array $attributes): Job
    {
        $validated = Validator::make($attributes, [
            'active' => ['sometimes', 'bool'],
            'content' => ['sometimes', 'array'],
            'content.title' => ['nullable', 'string'],
            'content.content' => ['nullable', 'string'],
            'content.meta_description' => ['nullable', 'string'],
            'content.vorschau_text' => ['nullable', 'string'],
            'content.workplace' => ['nullable', 'string'],
            'content.worktime' => ['nullable', 'string'],
            'content.vorschauPic' => ['nullable', 'url'],
            'permapath' => ['sometimes', Rule::unique('articles', 'permapath')->ignore($job->id)],
        ])->validate();

        return DB::transaction(function () use ($validated, $job) {
            if (isset($validated['content'])) {
                $job->content->update($validated['content']);
            }

            $job->update([
                'active' => isset($validated['active']) ? ($validated['active'] ? 1 : 0) : $job->active,
                'permapath' => $validated['permapath'] ?? $job->permapath,
            ]);

            return $job;
        });
    }

    public function delete(Job $job): Job
    {
        return DB::transaction(function () use ($job) {
            $job->delete();

            return $job;
        });
    }

    public function restore(Job $job): Job
    {
        return DB::transaction(function () use ($job) {
            $job->restore();

            return $job;
        });
    }
}
