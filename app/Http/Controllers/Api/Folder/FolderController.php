<?php

namespace App\Http\Controllers\Api\Folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\FolderRepository;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\Folder\FolderCollection;
use Validator;
use App\Models\Folder;

class FolderController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $folders = new FolderCollection(Folder::get());
        if (is_null($folders)) {
            return $this->apiResponseError('No folder found.');
        }
        return $this->apiResponseSuccess($folders, 'Folders retrieved successfully.');
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
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $store = $this->folderRepository->store($request->all());
        $folder = new FolderResource($store);
        return $this->apiResponseSuccess($folder, 'Folder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Folder $folder)
    {
        $folders = new FolderResource($folder);
        if (is_null($folders)) {
            return $this->apiResponseError('No folders found.');
        }
        return $this->apiResponseSuccess($folders, 'All folders retrieved successfully.');
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
        $folder = $this->folderRepository->update($id, $request->all());
        Folder::find($id)->files()->sync($request['files']);
        $folder = new FolderResource(Folder::find($id));
        return $this->apiResponseSuccess($folder, 'Folder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->folderRepository->destroy($id);
        return $this->apiResponse204();
    }
    
}
