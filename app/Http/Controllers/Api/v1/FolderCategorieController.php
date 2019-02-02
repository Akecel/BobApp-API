<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\CategoryRepository;
use App\FolderCategorie;

class FolderCategorieController extends ApiController
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
        $catogories = FolderCategorie::with('files_types')->get();
        return $this->apiResponseSuccess($catogories->toArray(), 'All categories retrieved successfully.');
    }

    public function show($id)
    {
        $catogories = FolderCategorie::with('files_types')->find($id);
        return $this->apiResponseSuccess($catogories->toArray(), 'Category retrieved successfully.');
    }

}
