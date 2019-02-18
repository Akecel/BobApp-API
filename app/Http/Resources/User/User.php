<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Folder\Folder as FolderResource;
use App\Http\Resources\File\File as FileResource;

class User extends JsonResource
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
            'type' => 'user',
            'id' => (string)$this->id,
            'attributes' => [
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'birthdate' => $this->birthdate,
                'address' => $this->address,
                'postcode' => $this->postcode,
                'city' => $this->city,
                'country' => $this->country,
                'admin' => $this->when($this->admin, function () {
                    return (string)$this->admin;
                }),
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new UserRelationshipResource($this),
            'links' => [
                'self' => route('user.show', ['user' => $this->id]),
            ]
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

                if ($relation->count()) {
                    $modelRelation = get_class($this->{$nameRelation}()->getRelated());
                    if($nameRelation == "folders") {
                        $relationships[$nameRelation][] = $relation->mapInto(FolderResource::class);
                    } 
                    elseif ($nameRelation == 'files') {
                        $relationships[$nameRelation][] = $relation->mapInto(FileResource::class);
                    }
                }
            }
        }
    return $relationships;
    }
}
