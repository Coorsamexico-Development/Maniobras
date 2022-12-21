<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'type' => 'users',
            'id' => (string)$this->id,
            'attributes' => [
                'role_id' => $this->role_id,
                'username' => $this->name,
                'nombre' => $this->nombre,
                'ap_paterno' => $this->ap_paterno,
                'ap_materno' => $this->ap_materno,
                'email' => $this->email,
                'is_admin' => $this->is_admin,
            ],
            'links' => [
                'selft' => $request->url()
            ]
        ];
    }
}
