<?php

namespace App\Http\Controllers\Api\FolderCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\Api\ApiController as ApiController;

use App\Repositories\CategoryRepository;
use App\Http\Resources\FolderCategory\FolderCategory as FolderCategoryResource;
use App\Http\Resources\FolderCategory\FolderCategoryCollection;
use App\Models\FolderCategory; 

class FolderCategoryController extends ApiController
{
    /**
     * The with request instance.
     */

    protected $withs = [];

    /**
     * The category repository instance.
     */

    protected $categoryRepository;

    /**
     * Controller instance
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\CategoryRepository $categoryRepository
     * @codeCoverageIgnore
     */
  
    public function __construct(Request $request, CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return new FolderCategoryCollection(FolderCategory::with($this->withs)->get());
    }

    /**
     * Display given resource
     * @param  App\Models\FolderCategory $category
     * @return \Illuminate\Http\Response
     */

    public function show(FolderCategory $category)
    {
        return new FolderCategoryResource(FolderCategory::with($this->withs)->find($category->id));
    }

    /**
     * Update given resource
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\FolderCategory $category
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, FolderCategory $category)
    {
        $this->authorize('adminManage', $category);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $id = $category->id;
        $this->categoryRepository->update($id, $request->all());
        return new FolderCategoryResource(FolderCategory::find($id));
    }

}
