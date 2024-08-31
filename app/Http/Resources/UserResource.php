<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 * 		description="Информация о пользователе",
 * 		title="Получение пользователя",
 * 		@OA\Property(
 * 			property="id",
 * 			type="integer",
 * 			description="Идентификатор пользователя",
 * 			example=1
 * 		),
 * 		@OA\Property(
 * 			property="name",
 * 			type="string",
 * 			description="Имя пользователя",
 * 			example="Иван"
 * 		),
 * 		@OA\Property(
 * 			property="email",
 * 			type="string",
 * 			description="Email пользователя",
 * 			example="ivan@example.com"
 * 		),
 * 		@OA\Property(
 * 			property="created_at",
 * 			type="string",
 * 			description="Дата создания пользователя",
 *          example="01/01/2020"
 * 		),
 * 		@OA\Property(
 * 			property="updated_at",
 * 			type="string",
 * 			description="Дата обновления пользователя",
 *          example="01/01/2020"
 * 		)
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
