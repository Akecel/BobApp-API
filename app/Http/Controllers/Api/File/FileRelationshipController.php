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
     * Display relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     */

    public function user(File $file)
    {
        $this->authorize('manage', $file);
        return new UserResource($file->user);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function fileRelationshipUser(File $file)
    {
        $this->authorize('manage', $file);
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['user']);
    }

    /**
     * Display relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     */

    public function folders(File $file)
    {
        $this->authorize('manage', $file);
        return new FolderCollection($file->folders);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function fileRelationshipFolder(File $file)
    {
        $this->authorize('manage', $file);
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['folders']);
    }

    /**
     * Display relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     */

    public function type(File $file)
    {
        $this->authorize('manage', $file);
        return new FileTypeResource($file->file_type);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\File $file
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function fileRelationshipType(File $file)
    {
        $this->authorize('manage', $file);
        $relationship = (new FileRelationshipResource($file))->jsonSerialize();
        return array_reverse($relationship['type']);
    }
}