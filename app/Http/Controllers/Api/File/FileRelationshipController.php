<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\FileType\FileType as FileTypeResource;
use App\Http\Resources\Folder\FolderCollection;

use App\Models\File;

class FileRelationshipController extends Controller
{
    public function user(File $file)
    {
        return new UserResource($file->user);
    }

    public function folders(File $file)
    {
        return new FolderCollection($file->folders);
    }

    public function type(File $file)
    {
        return new FileTypeResource($file->file_type);
    }
}