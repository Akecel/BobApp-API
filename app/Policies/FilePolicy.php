<?php

namespace App\Policies;

use App\Models\{User, File};
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy extends ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given file can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return bool
     */

    public function manage(User $user, File $file)
    {
        return $user->id === $file->user_id;
    }
}
