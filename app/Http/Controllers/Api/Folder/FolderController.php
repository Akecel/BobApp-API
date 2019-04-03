<?php

namespace App\Http\Controllers\Api\Folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Api\ApiController as ApiController;

use App\Repositories\FolderRepository;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\Folder\FolderCollection;
use App\Models\Folder;

class FolderController extends ApiController
{
    /**
     * The with request instance.
     */

    protected $withs = [];

    /**
     * The folder repository instance.
     */

    protected $folderRepository;

    /**
     * Controller instance
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\FolderRepository $folderRepository
     * @codeCoverageIgnore
     */
    public function __construct(Request $request, FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, Folder $folder)
    {
        $this->authorize('adminManage', $folder);
        return new FolderCollection(Folder::with($this->withs)->get());
    }

    /**
     * Store a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'user_id' => 'required|max:255'
        ]);
        if($validator->fails()){
            // @codeCoverageIgnoreStart
            return $this->apiResponse403('Validation Error', $validator->errors());
            // @codeCoverageIgnoreEnd      
        }
        $store = $this->folderRepository->store($request->all());
        return (new FolderResource($store))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display given resource
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */

    public function show(Folder $folder)
    {
        $this->authorize('manage', $folder);
        return new FolderResource(Folder::with($this->withs)->find($folder->id));
    }

    /**
     * Update given resource
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Folder $folder)
    {
        $this->authorize('manage', $folder);
        $id = $folder->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if($validator->fails()){
            // @codeCoverageIgnoreStart
            return $this->apiResponse403('Validation Error', $validator->errors());  
            // @codeCoverageIgnoreEnd     
        }
        $folder = $this->folderRepository->update($id, $request->all());
        Folder::find($id)->files()->sync($request['files']);
        return new FolderResource(Folder::find($id));
    }

    /**
     * Remove given resource
     * @param  App\Models\Folder $folder
     * @return \Illuminate\Http\Response
     */

    public function destroy(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $id = $folder->id;
        $folder = Folder::find($id);
        $this->folderRepository->destroy($id);
        return $this->apiResponse204();
    }
    
}
