<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Job $job): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Job $job): bool
    {
        return true;
    }

    public function delete(User $user, Job $job): bool
    {
        return true;
    }

    public function restore(User $user, Job $job): bool
    {
        return true;
    }

    public function forceDelete(User $user, Job $job): bool
    {
        return true;
    }
}
