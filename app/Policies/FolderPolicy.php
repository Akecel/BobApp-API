<?php

namespace App\Policies;

use App\Models\ {User, Folder};
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy extends ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return bool
     */

    public function manage(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}
