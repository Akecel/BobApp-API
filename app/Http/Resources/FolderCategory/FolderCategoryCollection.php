<?php

namespace App\Http\Resources\FolderCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class FolderCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
