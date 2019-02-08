<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\FileType\FileType as FileTypeResource;
use App\Http\Resources\Folder\FolderCollection;
use App\Http\Resources\File\FileRelationshipResource;
use App\Models\File;

class FileRelationshipController extends Controller
{
    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function user(File $file)
    {
        return new UserResource($file->user);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function fileRelationshipUser(File $file)
    {
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['user']);
    }

    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function folders(File $file)
    {
        return new FolderCollection($file->folders);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function fileRelationshipFolder(File $file)
    {
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['folders']);
    }

    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function type(File $file)
    {
        return new FileTypeResource($file->file_type);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function fileRelationshipType(File $file)
    {
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['type']);
    }
}