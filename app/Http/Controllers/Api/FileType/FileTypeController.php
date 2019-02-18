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
  
    public function __construct(TypeRepository $typeRepository)
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

    public function index(Request $request)
    {
        $types = new FileTypeCollection(FileType::with($this->withs)->get());
        if (is_null($types)) {
            return $this->apiResponse404('No type found');
        }
        return $this->apiResponse200($types);
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
        $type = new FileTypeResource($type);
        if (is_null($type)) {
            return $this->apiResponse404('No type found');
        }
        return $this->apiResponse200($type);
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
        $this->authorize('adminManage', $type);
        $id = $type->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->typeRepository->update($id, $request->all());
        $type = new FileTypeResource(FileType::find($id));
        return $this->apiResponse200($type);
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
        if (is_null($filetype)) {
            return $this->apiResponse404('Type do not exist');
        }
        $this->typeRepository->destroy($id);
        return $this->apiResponse204();
    }
    

}
