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
     * Display relationships resources
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */

    public function user(Folder $folder)
    {
        $this->authorize('manage', $folder);
        return new UserResource($folder->user);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */
    public function folderRelationshipUser(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $relationship = (new FolderRelationshipResource($folder))->jsonSerialize();
        return array_reverse($relationship['user']);
    }

    /**
     * Display relationships resources
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */

    public function files(Folder $folder)
    {
        $this->authorize('manage', $folder);
        return new FileCollection($folder->files);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */
    public function folderRelationshipFile(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $relationship = (new FolderRelationshipResource($folder))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}