<?php

namespace App\Repositories;

use App\Models\FolderCategory;

class CategoryRepository extends ResourceRepository
{

    public function __construct(FolderCategory $folderCategorie)
	{
		$this->model = $folderCategorie;
	}


}