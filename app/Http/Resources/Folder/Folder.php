<?php

namespace App\Http\Resources\Folder;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\File\File as FileResource;

class Folder extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     
    public function toArray($request)
    {
        return [
            'type' => 'folder',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new FolderRelationshipResource($this),
            'links' => [
                'self' => route('folder.show', ['folder' => $this->id]),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function with($request) 
    {
        $included = [];

        if ($request->has('include')) {
            return [
                'included' => [
                    $this->withIncluded()
                ],
                'links' => [
                    'self' => $request->fullUrl(),
                ]
            ];
        }
        else return [];
    }

    /**
     * Retrieve the relationships that have been included.
     *
     * @return array
     */

    private function withIncluded(): array
    {
        $relationships = [];
        
        $relations = $this->getRelations();

        if (!empty($relations)) {
            foreach ($relations as $nameRelation => $relation) { 
                $modelRelation = get_class($this->{$nameRelation}()->getRelated());
                if($nameRelation == "user") {
                    $relationships[$nameRelation][] = new UserResource($relation);
                } 
                elseif ($nameRelation == 'files') {
                    $relationships[$nameRelation][] = $relation->mapInto(FileResource::class);
                }
            }
        }
        return $relationships;
    }
}
