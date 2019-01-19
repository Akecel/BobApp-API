<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\FolderRepository;
use App\Repositories\UserRepository;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = $this->folderRepository->this->model->all();
        return $this->apiResponseSuccess($users, 'Users retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::with('userinfo','address')->find($id);
        if (is_null($user)) {
            return $this->apiResponseError('User not found.');
        }
        return $this->apiResponseSuccess($user->toArray(), 'User retrieved successfully.');
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
        $this->userRepository->update($id, $request->all());
        $this->userRepository->updateUserInfo($id, $request->only('lastName','firstName','birthdate'));
        $this->userRepository->updateUserAddress($id, $request->only('address','postal_code','country','city'));
        $user = User::with('userinfo','address')->find($id);
        return $this->apiResponseSuccess($user->toArray(), 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return $this->apiResponseSuccess($user->toArray(), 'User deleted successfully.');
    }
    
}
