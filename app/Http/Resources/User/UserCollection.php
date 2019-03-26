<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\File\File as FileResource;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $included = $this->withIncluded($this);

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
                        if($nameRelation == "folders") {
                            $relationships[$nameRelation][] = $relation->mapInto(FolderResource::class);
                        } 
                        elseif ($nameRelation == 'files') {
                            $relationships[$nameRelation][] = $relation->mapInto(FileResource::class);
                        }
                    }
                }
            }
        }
        return $relationships;
    }
}
