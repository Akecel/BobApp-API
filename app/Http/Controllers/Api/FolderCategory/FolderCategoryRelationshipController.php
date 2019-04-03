<?php

namespace App\Http\Controllers\Api\FolderCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileType\FileTypeCollection;
use App\Http\Resources\FolderCategory\FolderCategoryRelationshipResource;
use App\Models\FolderCategory;

class FolderCategoryRelationshipController extends Controller
{
    /**
     * Display relationships resources
     * @param  App\Models\FolderCategory $category
     * @return \Illuminate\Http\Response
     */

    public function types(FolderCategory $category)
    {
        return new FileTypeCollection($category->files_types);
    }

    /**
     * Display specified relationships resources
     * @param  App\Models\FolderCategory $category
     * @return \Illuminate\Http\Response
     * @codeCoverageIgnore
     */

    public function categoryRelationshipType(FolderCategory $category)
    {
        $relationship = (new FolderCategoryRelationshipResource($category))->jsonSerialize();
        return array_reverse($relationship['types']);
    }
}