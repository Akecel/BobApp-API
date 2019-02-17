<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\FileType\FileType as FileTypeResource;

class FileCollection extends ResourceCollection
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
                        $modelRelation = get_class($resource->{$nameRelation}()->getRelated());
                        if($nameRelation == "user") {
                            $relationships[$nameRelation][] = new UserResource($relation);
                        } 
                        elseif ($nameRelation == 'folders') {
                            $relationships[$nameRelation][] = $relation->mapInto(FolderResource::class);
                        }
                        elseif ($nameRelation == 'file_type') {
                            $relationships[$nameRelation][] = new FileTypeResource($relation);
                        }
                    }
                }
            }
        }
        return $relationships;
    }
}
