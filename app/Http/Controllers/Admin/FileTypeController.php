<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
use App\Http\Controllers\Controller as Controller;

class FileTypeController extends Controller 
{

    /**
    * Set User Repository and Paginate.
    * Constructor
    */


    protected $typeRepository;
    protected $nbrPerPage = 50;
  
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $types = $this->typeRepository->getPaginate($this->nbrPerPage);
    $links = $types->render();
    return view('types/indexType', compact('types', 'links'));
  }
  
}

?>