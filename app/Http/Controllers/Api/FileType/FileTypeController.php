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
     * The with request instance.
     */

    protected $withs = [];

    /**
     * The type repository instance.
     */

    protected $typeRepository;

    /**
     * Controller instance
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\TypeRepository $typeRepository
     * @codeCoverageIgnore
     */
    public function __construct(Request $request, TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of resource.
     * @param  \Illuminate\Http\Request  $request
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
     * Display given resource
     * @param  App\Models\FileType $type
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
     * Update given resource
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\FileType $type
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, FileType $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            // @codeCoverageIgnoreStart
            return $this->apiResponse403('Validation Error', $validator->errors()); 
            // @codeCoverageIgnoreEnd      
        }
        $this->authorize('adminManage', $type);
        $id = $type->id;
        $this->typeRepository->update($id, $request->all());
        return  new FileTypeResource(FileType::find($id));
    }
    
}
