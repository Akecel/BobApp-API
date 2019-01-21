<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\FileRepository;
use Validator;
use App\File;

class FileController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $fileRepository;

    public function __construct(FileRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
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
            'url' => 'required|max:255',
            'file_type_id' => 'required|max:255',
            'user_id' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $file = $this->fileRepository->store($request->all());
        return $this->apiResponseSuccess($file, 'File created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $files = File::where('user_id', $id)->with('user','file_type','folders')->get();
        if (is_null($files)) {
            return $this->apiResponseError('No files found.');
        }
        return $this->apiResponseSuccess($files->toArray(), 'All files retrieved successfully.');
    }

    public function edit($id)
    {
        $files = File::find($id)->with('user','file_type','folders')->get();
        if (is_null($files)) {
            return $this->apiResponseError('File not found.');
        }
        return $this->apiResponseSuccess($files->toArray(), 'File retrieved successfully.');
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
        File::find($id)->files()->sync(array_unique($request['files']));
        $file = File::with('folder','file_type','user')->find($id);
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
        $this->fileRepository->destroy($id);
        return $this->apiResponseSuccess('File', 'File deleted successfully.');
    }
    
}
