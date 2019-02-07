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
        if (is_null($categories)) {
            return $this->apiResponseError('No category found.');
        }
        return $this->apiResponseSuccess($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $store = $this->categoryRepository->store($request->all());
        $category = new FolderCategoryResource($store);
        return $this->apiResponseSuccess($category);
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
            return $this->apiResponseError('No category found.');
        }
        return $this->apiResponseSuccess($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $this->categoryRepository->update($id, $request->all());
        $category = new FolderCategoryResource(FolderCategory::find($id));
        return $this->apiResponseSuccess($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);
        return $this->apiResponse204();
    }

}
