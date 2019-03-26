<?php

namespace App\Http\Resources\FolderCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\Http\Resources\FileType\FileType as FileTypeResource;

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
        return[
            'data' => $this->collection,
            'links' => [
                'self' => url()->current(),
            ],
            'included' => $this->when(
                $request->has('include'),
                function () {
                    return $this->withIncluded();
                }
            )
        ];
    }

    /**
     * Retrieve the relationships that have been included.
     *
     * @return array
     */

    private function withIncluded(): array
    {
        $relationships = [];

        foreach ($this->collection as $resource) {

            $relations = $resource->getRelations();

            if (!empty($relations)) {
                foreach ($relations as $nameRelation => $relation) {

                    if ($relation->count()) {
                        get_class($resource->{$nameRelation}()->getRelated());
                        if($nameRelation == "files_types") {
                            $relationships[$nameRelation][] = $relation->mapInto(FileTypeResource::class);
                        } 
                    }
                }
            }
        }
        return $relationships;
    }
}
