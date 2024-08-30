<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 * 		description="Информация о посте",
 * 		title="Создание поста",
 * 		required={"title", "description"},
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
 * 		)
 * )
 */
class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.max' => 'Максимальная длина заголовка 255 символов',
            'description.required' => 'Поле "Описание" обязательно для заполнения',
            'description.max' => 'Максимальная длина описания 255 символов',
        ];
    }
}
