<?php

namespace App\Policies;

use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }

    public function delete(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }

    public function restore(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }

    public function forceDelete(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }
}
