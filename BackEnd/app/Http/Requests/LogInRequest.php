<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LogInRequest extends FormRequest
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
        // Define your validation rules here if x-browser-mode header is not present or set to true
        return [
            'username' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->where('username', request()->input('username'))
                        ->orWhere('email', request()->input('username'));
                }),
            ],
            'password' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
