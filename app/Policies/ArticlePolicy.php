<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Article $article): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Article $article): bool
    {
        return true;
    }

    public function delete(User $user, Article $article): bool
    {
        return true;
    }

    public function restore(User $user, Article $article): bool
    {
        return true;
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return true;
    }
}
