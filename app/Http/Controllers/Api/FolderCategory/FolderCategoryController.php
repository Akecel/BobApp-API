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
     * Set User Repository.
     * Constructor
     */

    protected $withs = [];

    protected $categoryRepository;
  
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categories = new FolderCategoryCollection(FolderCategory::with($this->withs)->get());
        if (is_null($categories)) {
            return $this->apiResponse404('No category found');
        }
        return $this->apiResponse200($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, FolderCategory $category)
    {
        $this->authorize('adminManage', $category);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $store = $this->categoryRepository->store($request->all());
        $category = new FolderCategoryResource($store);
        return $this->apiResponse201($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(FolderCategory $category)
    {
        $category = new FolderCategoryResource($category);
        if (is_null($category)) {
            return $this->apiResponse404('No category found');
        }
        return $this->apiResponse200($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, FolderCategory $category)
    {
        $this->authorize('adminManage', $category);
        $id = $category->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->categoryRepository->update($id, $request->all());
        $category = new FolderCategoryResource(FolderCategory::find($id));
        return $this->apiResponse200($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(FolderCategory $category)
    {
        $this->authorize('adminManage', $category);
        $id = $category->id;
        $category = FolderCategory::find($id);
        if (is_null($category)) {
            return $this->apiResponse404('Category do not exist');
        }
        $this->categoryRepository->destroy($id);
        return $this->apiResponse204();
    }

}
