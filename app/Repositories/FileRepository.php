<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository extends ResourceRepository
{

    public function __construct(File $file)
	{
		$this->model = $file;
	}

	public function saveOtherFile($file, $inputs)
    {
        $file->other_file()->create($inputs);
    }

    public function updateOtherFile($id, Array $inputs)
    {
        $file = $this->getById($id);
        $file->other_file()->update($inputs);
    }


}