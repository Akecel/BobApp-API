<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller as Controller;

class UserController extends Controller
{
    /**
     * Set User Repository and Paginate.
     * Constructor
     */


    protected $userRepository;
    protected $nbrPerPage = 50;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPaginate($this->nbrPerPage);
        $links = $users->render();
        return view('users/indexUser', compact('users', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->setAdmin($request);
        $user = $this->userRepository->store($request->all());
        $this->userRepository->saveUserInfo($user,$request->only('lastName','firstName','birthdate'));
        $this->userRepository->saveUserAddress($user, $request->only('address','postal_code','country','city'));
		return redirect('user')->withOk("L'utilisateur a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('users/showUser',  compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('users/editUser',  compact('user'));
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
        $this->setAdmin($request);
        $this->userRepository->update($id, $request->all());
        $this->userRepository->updateUserInfo($id, $request->only('lastName','firstName','birthdate'));
        $this->userRepository->updateUserAddress($id, $request->only('address','postal_code','country','city'));
        return redirect('user')->withOk("L'utilisateur a été modifié.");
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
		return back();
    }

    /**
     * Admin.
     */

    private function setAdmin($request)
    {
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }       
    }
}
