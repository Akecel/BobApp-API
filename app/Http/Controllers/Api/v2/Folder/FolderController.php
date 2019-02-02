<?php

namespace App\Http\Controllers\Api\v2\Folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\FolderRepository;
use Validator;
use App\Folder;

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
        $folder = $this->folderRepository->store($request->all());
        return $this->apiResponseSuccess($folder, 'Folder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $folders = Folder::where('user_id', $id)->with('files','user')->get();
        if (is_null($folders)) {
            return $this->apiResponseError('No folders found.');
        }
        return $this->apiResponseSuccess($folders->toArray(), 'All folders retrieved successfully.');
    }

    public function edit($id)
    {
        $folders = Folder::with('files','user')->find($id);
        if (is_null($folders)) {
            return $this->apiResponseError('Folder not found.');
        }
        return $this->apiResponseSuccess($folders->toArray(), 'Folder retrieved successfully.');
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
        Folder::find($id)->files()->sync(array_unique($request['files']));
        $folder = Folder::with('files','user')->find($id);
        return $this->apiResponseSuccess($folder->toArray(), 'Folder updated successfully.');
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
        return $this->apiResponseSuccess($folder->toArray(), 'Folder deleted successfully.');
    }
    
}
