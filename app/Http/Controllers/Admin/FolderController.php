<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\FolderRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller as Controller;

class FolderController extends Controller 
{

    /**
     * Set User Repository and Paginate.
     * Constructor
     */


  protected $folderRepository;
  protected $nbrPerPage = 5;

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
    $folders = $this->folderRepository->getPaginate($this->nbrPerPage);
    $links = $folders->render();
    return view('folders/indexFolder', compact('folders', 'links'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */

  public function create(UserRepository $userRepository)
  {
    $users = $userRepository->getAllSelect()->toArray();
    return view('folders/createFolder',compact('users'));
  }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

  public function store(Request $request)
  {
    return $this->folderRepository->store($request->all());
    return redirect('folder')->withOk("Le dossier a été créé.");
  }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

  public function show($id)
  {
    $folder = $this->folderRepository->getById($id);
    return view('folders/showFolder',  compact('folder'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

  public function edit(UserRepository $userRepository, $id)
  {
    $users = $userRepository->getAllSelect();
    $folder = $this->folderRepository->getById($id);
    return view('folders/editFolder',  compact('folder','users'));
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
    $this->folderRepository->update($id, $request->all());
    return redirect('folder')->withOk("Le dossier a été modifié.");
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
		return back();
  }
  
}

?>