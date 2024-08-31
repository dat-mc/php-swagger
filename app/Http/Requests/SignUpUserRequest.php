<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 * 		description="Данные пользователя для регистрации",
 * 		title="Регистрация пользователя",
 * 		required={"name", "email", "password"},
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
 * 			property="password",
 * 			type="string",
 * 			description="Пароль пользователя",
 * 			example="123456"
 * 		)
 * )
 */
class SignUpUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.max' => 'Максимальная длина имени 255 символов',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.max' => 'Максимальная длина email 255 символов',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.max' => 'Максимальная длина пароля 255 символов',
        ];
    }
}
