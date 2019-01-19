<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\TypeRepository;
use App\FileType;

class FileTypeController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $typeRepository;
  
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $types = FileType::with('folder_categorie')->get();
        return $this->apiResponseSuccess($types->toArray(), 'All types retrieved successfully.');
    }

    public function show($id)
    {
        $types = FileType::with('folder_categorie')->find($id);
        return $this->apiResponseSuccess($types, 'Type retrieved successfully.');
    }
    

}
