<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersItems;
use App\Http\Requests\FeedRequest;
use App\Models\Article;
use App\Models\Job;

class FeedController extends Controller
{
    use FiltersItems;

    public function job(Job $job)
    {
        return response()->json($job->makeHidden(['id', 'user_id', 'content_id', 'content.id', 'user.id', 'category.id']));
    }

    public function article(Article $article)
    {
        return response()->json($article->makeHidden(['id', 'user_id', 'content_id', 'content.id', 'user.id', 'category.id']));
    }

    public function jobs(FeedRequest $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: ['feed'],
            query: Job::active(),
            hiddenFields: ['id', 'user_id', 'content_id', 'content.id', 'user.id', 'category.id'],
        ));
    }

    public function articles(FeedRequest $request)
    {
        return response()->json($this->filter(
            filterValues: $request->input('filters', []),
            filters: ['articles'],
            query: Article::active(),
            hiddenFields: ['id', 'content.id', 'user.id', 'category.id'],
        ));
    }
}
