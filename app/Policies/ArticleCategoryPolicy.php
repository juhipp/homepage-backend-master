<?php

namespace App\Policies;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ArticleCategory $articleCategory): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ArticleCategory $articleCategory): bool
    {
        return true;
    }

    public function delete(User $user, ArticleCategory $articleCategory): bool
    {
        return true;
    }

    public function restore(User $user, ArticleCategory $articleCategory): bool
    {
        return true;
    }

    public function forceDelete(User $user, ArticleCategory $articleCategory): bool
    {
        return true;
    }
}
