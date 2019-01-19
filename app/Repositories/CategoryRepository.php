<?php

namespace App\Repositories;

use App\FolderCategorie;

class CategoryRepository extends ResourceRepository
{

    public function __construct(FolderCategorie $folderCategorie)
	{
		$this->model = $folderCategorie;
	}


}