<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller as Controller;

class FolderCategorieController extends Controller 
{
      /**
     * Set User Repository and Paginate.
     * Constructor
     */


    protected $categoryRepository;
    protected $nbrPerPage = 50;
  
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
  

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories = $this->categoryRepository->getPaginate($this->nbrPerPage);
    $links = $categories->render();
    return view('categories/indexCategory', compact('categories', 'links'));
  }

  
}

?>