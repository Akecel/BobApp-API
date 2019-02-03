<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\Folder\FolderCollection;

use App\File;

class FileRelationshipController extends Controller
{
    public function user(File $file)
    {
        return new UserResource($file->user);
    }

    public function files(File $file)
    {
        return new FolderCollection($file->folders);
    }

    public function type(File $file)
    {
        return new TypeCollection($file->type);
    }
}