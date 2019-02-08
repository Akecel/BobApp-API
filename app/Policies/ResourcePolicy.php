<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->admin == 1) {
            return true;
        }
    }

    public function adminManage(User $user)
    {
        return $user->admin === 1;
    }

    
}
