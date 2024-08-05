<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'requiredmin:8'
        ];
    }

    public function messages(): array{
        return [
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.exists' => 'Email chưa được đăng ký!',
            'password.required' => 'Vui lòng nhập password!',
            'password.min' => 'Password quá ngắn!'
        ];
    }
}
