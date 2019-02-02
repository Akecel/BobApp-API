<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\FileRepository;
use Validator;
use App\File;
use App\User;
use App\FileType;

class FileController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
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
            'file_type_id' => 'required|max:255',
            'user_id' => 'required|max:255',
            'file_input' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $user_id = $request['user_id'];
        $file_type_id = $request['file_type_id'];
        $user = User::where('id', $user_id)->first();
        $type = FileType::where('id', $file_type_id)->first();

        $image = $request->file('file_input');
        $name = $type['title'] . '.' . $user['lastName'] . $user['firstName'] . '.' . mt_rand(100000, 999999) . '.'  . $image->getClientOriginalExtension();
        $destinationPath = "storage/user_files_" . $user_id;
        $image->move($destinationPath, $name);
        $request['url'] =$_ENV['APP_URL'] . "/" . $destinationPath . "/" . $name;

        $store = $this->fileRepository->store($request->all());

        if($request->has('foders')) {
            $file->folders()->sync(array_unique($request['folders']));
        }
        $file = File::with('folders','file_type','user')->find($store['id']);
        return $this->apiResponseSuccess($file, 'File uploaded successfully.');

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
        File::find($id)->folders()->sync(array_unique($request['files']));
        $file = File::with('folder','file_type','user')->find($id);
        return $this->apiResponseSuccess($file->toArray(), 'Folder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $file = File::find($id);
        $url = explode($_ENV['APP_URL'] . "/storage/",$file['url']);
        Storage::disk('public')->delete($url[1]);
        $this->fileRepository->destroy($id);
        return $this->apiResponseSuccess('File', 'File deleted successfully.');
    }
    
}
