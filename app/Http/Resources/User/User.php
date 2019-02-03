<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

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
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new UserRelationshipResource($this),
            'links' => [
                'self' => route('user.show', ['user' => $this->id]),
            ],
        ];
    }
}
