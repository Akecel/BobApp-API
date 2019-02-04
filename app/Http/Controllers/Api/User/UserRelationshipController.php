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
     * 
     * Display all relationships of resources.
     *
     */

    public function folders(User $user)
    {
        return new FolderCollection($user->folders);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function userRelationshipFolder(User $user)
    {
        $relationship = (new UserRelationshipResource($user))->jsonSerialize();
        return array_reverse($relationship['folders']);
    }

    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function files(User $user)
    {
        return new FileCollection($user->files);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function userRelationshipFile(User $user)
    {
        $relationship = (new UserRelationshipResource($user))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}