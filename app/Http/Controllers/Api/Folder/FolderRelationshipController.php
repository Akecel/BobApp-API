<?php

namespace App\Http\Controllers\Api\Folder;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\Folder\FolderRelationshipResource;
use App\Models\Folder;

class FolderRelationshipController extends Controller
{
    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function user(Folder $folder)
    {
        $this->authorize('manage', $folder);
        return new UserResource($folder->user);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function folderRelationshipUser(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $relationship = (new FolderRelationshipResource($folder))->jsonSerialize();
        return array_reverse($relationship['user']);
    }

    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function files(Folder $folder)
    {
        $this->authorize('manage', $folder);
        return new FileCollection($folder->files);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function folderRelationshipFile(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $relationship = (new FolderRelationshipResource($folder))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}