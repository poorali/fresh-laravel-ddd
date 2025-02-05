<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $roleRepository = new ProjectRoleRepository(new ProjectRole());
        return [
            'id' => $this->uuid,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'gender' => $this->gender,
            'summary' => $this->summary,
            'timezone' => $this->timezone,
            'social_driver' => $this->social_driver,
        ];
    }
}
