<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\User;
use App\Policies\ArticleCategoryPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\JobCategoryPolicy;
use App\Policies\JobPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Job::class => JobPolicy::class,
        JobCategory::class => JobCategoryPolicy::class,
        User::class => UserPolicy::class,
        ArticleCategory::class => ArticleCategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
