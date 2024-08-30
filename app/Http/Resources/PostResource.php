<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 * 		description="Информация о посте",
 * 		title="Получение поста",
 * 		@OA\Property(
 * 			property="id",
 * 			type="integer",
 * 			description="Идентификатор поста",
 * 			example=1
 * 		),
 * 		@OA\Property(
 * 			property="title",
 * 			type="string",
 * 			description="Заголовок поста",
 * 			example="Мой пост"
 * 		),
 * 		@OA\Property(
 * 			property="description",
 * 			type="string",
 * 			description="Описание поста",
 * 			example="Описание поста"
 * 		),
 * 		@OA\Property(
 * 			property="created_at",
 * 			type="string",
 * 			description="Дата создания поста",
 * 			example="01/01/2020"
 * 		),
 * 		@OA\Property(
 * 			property="updated_at",
 * 			type="string",
 * 			description="Дата обновления поста",
 * 			example="01/01/2020"
 * 		)
 * )
 */
class PostResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'description' => $this->description,
			'created_at' => $this->created_at->format('m/d/Y'),
			'updated_at' => $this->updated_at->format('m/d/Y'),
		];
	}
}
