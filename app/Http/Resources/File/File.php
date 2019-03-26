<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\FileType\FileType as FileTypeResource;

class File extends JsonResource
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
            'type' => 'file',
            'id' => (string)$this->id,
            'attributes' => [
                'url' => decrypt($this->url),
                'name' => $this->when(isset($this->other_file->name), function () {
                    return $this->other_file->name;
                }),
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new FileRelationshipResource($this),
            'links' => [
                'self' => route('file.show', ['file' => $this->id]),
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
                get_class($this->{$nameRelation}()->getRelated());
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
    return $relationships;
    }
}
