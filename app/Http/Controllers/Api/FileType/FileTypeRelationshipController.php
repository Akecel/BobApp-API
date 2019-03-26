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
     * Display relationships resources
     * @param  App\Models\FileType $type
     * @return \Illuminate\Http\Response
     */

    public function category(FileType $type)
    {
        return new FolderCategoryResource($type->folder_category);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\FileType $type
     * @return \Illuminate\Http\Response
     */

    public function typeRelationshipCategory(FileType $type)
    {
        $relationship = (new FileTypeRelationshipResource($type))->jsonSerialize();
        return array_reverse($relationship['category']);
    }

    /**
     * Display relationships resources
     * @param  App\Models\FileType $type
     * @return \Illuminate\Http\Response
     */

    public function files(FileType $type)
    {
        $this->authorize('adminManage', $type);
        return new FileCollection($type->files);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\FileType $type
     * @return \Illuminate\Http\Response
     */

    public function typeRelationshipFile(FileType $type)
    {
        $this->authorize('adminManage', $type);
        $relationship = (new FileTypeRelationshipResource($type))->jsonSerialize();
        return array_reverse($relationship['files']);
    }
}