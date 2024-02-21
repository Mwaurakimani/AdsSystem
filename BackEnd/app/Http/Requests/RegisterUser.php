<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RegisterUser extends FormRequest
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
        // If x-browser-mode header is present and set to false, no need to validate
        if ($this->header('x-browser-mode') !== null && $this->header('x-browser-mode') === 'false') {
            return [];
        }

        // Define your validation rules here if x-browser-mode header is not present or set to true
        return [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'accountType' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'accountType' => 'Account Type',
            'password' => 'Password',
            'confirm_password' => 'Password Confirmation',
        ];
    }
}
