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
     * Set User Repository.
     * Constructor
     */

    protected $withs = [];

    protected $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;

        if ($request->has('include')) {
            $this->withs = explode(',', $request->include);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, Folder $folder)
    {
        $this->authorize('adminManage', $folder);
        $folders = new FolderCollection(Folder::with($this->withs)->get());
        if (is_null($folders)) {
            return $this->apiResponse404('No folder found');
        }
        return $this->apiResponse200($folders);
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
            'user_id' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $store = $this->folderRepository->store($request->all());
        $folder = new FolderResource($store);
        return $this->apiResponse201($folder);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $folders = new FolderResource($folder);
        if (is_null($folders)) {
            return $this->apiResponse404('No folders found');
        }
        return $this->apiResponse200($folders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $folder = $this->folderRepository->update($id, $request->all());
        Folder::find($id)->files()->sync($request['files']);
        $folder = new FolderResource(Folder::find($id));
        return $this->apiResponse200($folder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Folder $folder)
    {
        $this->authorize('manage', $folder);
        $id = $folder->id;
        $folder = Folder::find($id);
        if (is_null($folder)) {
            return $this->apiResponse404('Folder do not exist');
        }
        $this->folderRepository->destroy($id);
        return $this->apiResponse204();
    }
    
}
