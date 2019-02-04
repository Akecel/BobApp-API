<?php

namespace App\Http\Controllers\Api\FileType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\TypeRepository;
use App\Http\Resources\FileType\FileType as FileTypeResource;
use App\Http\Resources\FileType\FileTypeCollection;
use App\Models\FileType;

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
        $types = new FileTypeCollection(FileType::get());
        if (is_null($types)) {
            return $this->apiResponseError('No file type found.');
        }
        return $this->apiResponseSuccess($types, 'Types retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(FileType $type)
    {
        $type = new FileTypeResource($type);
        if (is_null($type)) {
            return $this->apiResponseError('No file type found.');
        }
        return $this->apiResponseSuccess($type, 'Type retrieved successfully.');
    }
    

}
