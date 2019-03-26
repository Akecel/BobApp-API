<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user is admin.
     *
     * @param  \App\User  $user
     * @return bool
     */

    public function before($user, $ability)
    {
        if ($user->admin == 1) {
            return true;
        }
    }

    /**
     * Determine if the given user is admin.
     *
     * @param  \App\User  $user
     * @return bool
     */

    public function adminManage(User $user)
    {
        return $user->admin === 1;
    }

    
}
