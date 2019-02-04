<?php

namespace App\Http\Controllers\Api\FolderCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\CategoryRepository;
use App\Http\Resources\FolderCategory\FolderCategory as FolderCategoryResource;
use App\Http\Resources\FolderCategory\FolderCategoryCollection;
use App\Models\FolderCategory;

class FolderCategoryController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $categoryRepository;
  
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = new FolderCategoryCollection(FolderCategory::get());
        return $this->apiResponseSuccess($categories, 'Categories retrieved successfully.');
    }

    public function show(FolderCategory $category)
    {
        $category = new FolderCategoryResource($category);
        return $this->apiResponseSuccess($category, 'Category retrieved successfully.');
    }

}
