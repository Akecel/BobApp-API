<?php

namespace App\Http\Controllers\Api\FileType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\Api\ApiController as ApiController;

use App\Repositories\TypeRepository;
use App\Http\Resources\FileType\FileType as FileTypeResource;
use App\Http\Resources\FileType\FileTypeCollection;
use App\Models\FileType;

class FileTypeController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $withs = [];

    protected $typeRepository;
  
    public function __construct(Request $request, TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(FileType $type)
    {
        if (!isset($this->withs->files)) {
            $this->authorize('adminManage', $type); 
        }
        return new FileTypeCollection(FileType::with($this->withs)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, FileType $type)
    {
        $this->authorize('adminManage', $type);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'folder_category_id' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $store = $this->typeRepository->store($request->all());
        $type = new FileTypeResource($store);
        return $this->apiResponse201($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(FileType $type)
    {
        if (!isset($this->withs->files)) {
            $this->authorize('adminManage', $type); 
        }
        return new FileTypeResource(FileType::with($this->withs)->find($type->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, FileType $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->authorize('adminManage', $type);
        $id = $type->id;
        $this->typeRepository->update($id, $request->all());
        return  new FileTypeResource(FileType::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(FileType $type)
    {
        $this->authorize('adminManage', $type);
        $id = $type->id;
        $filetype = FileType::find($id);
        $this->typeRepository->destroy($id);
        return $this->apiResponse204();
    }
    

}
