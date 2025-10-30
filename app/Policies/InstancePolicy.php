<?php

namespace App\Policies;

use App\Models\Instance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstancePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Instance $instance): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        $roles = [1, 2]; // IDs of roles allowed to create instances
        return in_array($user->role_id, $roles, true);
    }

    public function update(User $user, Instance $instance): bool
    {
        $roles = [1, 2]; // IDs of roles allowed to create instances
        return in_array($user->role_id, $roles, true);
    }

    public function delete(User $user, Instance $instance): bool
    {
        $roles = [1, 2]; // IDs of roles allowed to create instances
        return in_array($user->role_id, $roles, true);
    }

    public function restore(User $user, Instance $instance): bool
    {
        $roles = [1, 2]; // IDs of roles allowed to create instances
        return in_array($user->role_id, $roles, true);
    }

    public function forceDelete(User $user, Instance $instance): bool
    {
        return false;
    }
}
