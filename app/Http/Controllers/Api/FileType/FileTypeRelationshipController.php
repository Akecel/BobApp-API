<?php

namespace App\Http\Controllers\Api\FileType;

use App\Http\Controllers\Controller;
use App\Http\Resources\FolderCategory\FolderCategory as FolderCategoryResource;
use App\Http\Resources\File\FileCollection;

use App\Models\FileType;

class FileTypeRelationshipController extends Controller
{
    public function category(FileType $type)
    {
        return new FolderCategoryResource($type->folder_category);
    }

    public function files(FileType $type)
    {
        return new FileCollection($type->files);
    }
}