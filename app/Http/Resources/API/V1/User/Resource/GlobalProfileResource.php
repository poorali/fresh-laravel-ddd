<?php

namespace App\Http\Resources\API\V1\User\Resource;

use App\Http\Resources\API\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GlobalProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return collect(UserResource::make($this->resource))->only(['id', 'email', 'fullname', 'avatar','summary'])->toArray();
    }
}
