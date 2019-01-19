<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\FileRepository;
use App\Http\Controllers\Controller as Controller;

class FileController extends Controller 
{

    /**
    * Set User Repository and Paginate.
    * Constructor
    */


    protected $fileRepository;
    protected $nbrPerPage = 50;
  
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $files = $this->fileRepository->getPaginate($this->nbrPerPage);
    $links = $files->render();
    return view('files/indexFile', compact('files', 'links')); 
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $this->folderRepository->destroy($id);
		return back();
  }
  
}

?>