<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $model): bool
    {
        if($user->role_id === 1){
            return true;
        }
        if($user->empresas && $model->empresas){
            return $user->empresas->pluck('id')->intersect($model->empresas->pluck('id'))->isNotEmpty();
        }
        return false;
    }

    public function create(User $user): bool
    {
        $roles = [1, 2]; // IDs dos papéis que podem criar usuários
        if(in_array($user->role_id, $roles, true)){
            return true;
        }
        return false;
    }

    public function update(User $user, User $model): bool
    {
        $roles = [1, 2]; // IDs dos papéis que podem criar usuários
        if(in_array($user->role_id, $roles, true)){
            return true;
        }
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        $roles = [1, 2]; // IDs dos papéis que podem criar usuários
        if(in_array($user->role_id, $roles, true)){
            return true;
        }
        return false;
    }

    public function restore(User $user, User $model): bool
    {
        $roles = [1, 2]; // IDs dos papéis que podem criar usuários
        if(in_array($user->role_id, $roles, true)){
            return true;
        }
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->role_id === 1;
    }
}
