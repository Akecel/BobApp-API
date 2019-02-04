<?php

namespace App\Http\Controllers\Api\FileType;

use App\Http\Controllers\Controller;
use App\Http\Resources\FolderCategory\FolderCategory as FolderCategoryResource;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\FileType\FileTypeRelationshipResource;

use App\Models\FileType;

class FileTypeRelationshipController extends Controller
{
    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function category(FileType $type)
    {
        return new FolderCategoryResource($type->folder_category);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function typeRelationshipCategory(FileType $type)
    {
        $relationship = (new FileTypeRelationshipResource($type))->jsonSerialize();
        return array_reverse($relationship['category']);
    }

    /**
     * 
     * Display all relationships of resources.
     *
     */

    public function files(FileType $type)
    {
        return new FileCollection($type->files);
    }

    /**
     * 
     * Display specified relationship of resources.
     *
     */

    public function typeRelationshipFile(FileType $type)
    {
        $relationship = (new FileTypeRelationshipResource($type))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}