<?php

namespace App\Http\Controllers\Api\FolderCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileType\FileTypeCollection;

use App\Models\FolderCategory;

class FolderCategoryRelationshipController extends Controller
{
    public function types(FolderCategory $category)
    {
        return new FileTypeCollection($category->files_types);
    }
}