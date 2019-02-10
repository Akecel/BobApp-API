<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\Api\ApiController as ApiController;

use App\Repositories\FileRepository;
use App\Http\Resources\File\File as FileResource;
use App\Http\Resources\File\FileCollection;
use App\Models\{File, User, FileType};

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(File $file)
    {
        $this->authorize('adminManage', $file);
        $files = new FileCollection(File::get());
        if (is_null($files)) {
            return $this->apiResponse404('No file found');
        }
        return $this->apiResponse200($files);
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
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $user_id = $request['user_id'];
        $file_type_id = $request['file_type_id'];
        $user = User::where('id', $user_id)->first();
        $type = FileType::where('id', $file_type_id)->first();

        $image = $request->file('file_input');
        $name = $type['title'] . '.' . $user['lastName'] . $user['firstName'] . '.' . mt_rand(100000, 999999) . '.'  . $image->getClientOriginalExtension();
        $destinationPath = "storage/user_files_" . $user_id;
        $request['url'] = encrypt($_ENV['APP_URL'] . "/" . $destinationPath . "/" . $name);
        $store = $this->fileRepository->store($request->all());
        $image->move($destinationPath, $name);
        if($request->has('name')) {
        $this->fileRepository->saveOtherFile($store,$request->only('name'));
        }
        $file = new FileResource($store);
        return $this->apiResponse201($file);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(File $file)
    {
        $this->authorize('manage', $file);
        $file = new FileResource($file);
        if (is_null($file)) {
            return $this->apiResponse404('No file found');
        }
        return $this->apiResponse200($file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, File $file)
    {
        $this->authorize('manage', $file);
        $id = $file->id;
        $update = $this->fileRepository->update($id, $request->all());
        if($request->has('name')) {
        $this->fileRepository->updateOtherFile($id,$request->only('name'));
        }
        $file = new FileResource(File::find($id));
        return $this->apiResponse200($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(File $file)
    {
        $this->authorize('manage', $file);
        $id = $file->id;
        $file = File::find($id);
        if (is_null($file)) {
            return $this->apiResponse404('File do not exist');
        }
        $url = explode($_ENV['APP_URL'] . "/storage/",$file['url']);
        Storage::disk('public')->delete($url[1]);
        $this->fileRepository->destroy($id);
        return $this->apiResponse204();
    }
    
}
