<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $curUser, User $user) {
        return $curUser->id === $user->id;
    }

    public function destroy(User $curUser, User $user) {
        return $curUser->is_admin && $curUser->id !== $user->id;
    }

    public function follow(User $curUser, User $user) {
        return $curUser->id !== $user->id;
    }
}
