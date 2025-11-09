<?php

namespace Vanguard\Http\Requests\Auth;

use Vanguard\Http\Requests\Request;

class PasswordResetRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.*\d)(?=.*[A-Z]).*$/',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => "Please use at least one capital letter and one number"
        ];
    }
}
