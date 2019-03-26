<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\ResourcePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can be updated by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */

    public function manage(User $user, User $requested)
    {
        return $user->id === $requested->id;
    }
    
}
