<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Resources\Api\V1\StudentParent;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Country\Http\Resources\Api\V1\CountryResource;
use Modules\StudentParent\Models\StudentParent;
use Modules\User\Http\Resources\Api\V1\UserResource;

/**
 * @extends JsonResource<StudentParent>
 */
final class RegisterStudentParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var StudentParent $this */
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country_id' => $this->country_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => new UserResource($this->whenLoaded('user')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'students' => $this->whenLoaded('students', fn() => $this->students),
        ];
    }
}
