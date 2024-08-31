<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 * 		description="Данные пользователя для входа",
 * 		title="Вход пользователя",
 * 		required={"email", "password"},
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
class SignInUserRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.max' => 'Максимальная длина email 255 символов',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.max' => 'Максимальная длина пароля 255 символов',
        ];
    }
}
