<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Folder\FolderCollection;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\User\UserRelationshipResource;
use App\Models\User;

class UserRelationshipController extends Controller
{

    /**
     * Display relationships resources
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function folders(User $user)
    {
        $this->authorize('manage', $user);
        return new FolderCollection($user->folders);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function userRelationshipFolder(User $user)
    {
        $this->authorize('manage', $user);
        $relationship = (new UserRelationshipResource($user))->jsonSerialize();
        return array_reverse($relationship['folders']);
    }

    /**
     * Display relationships resources
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function files(User $user)
    {
        $this->authorize('manage', $user);
        return new FileCollection($user->files);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function userRelationshipFile(User $user)
    {
        $this->authorize('manage', $user);
        $relationship = (new UserRelationshipResource($user))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}