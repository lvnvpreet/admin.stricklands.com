<?php

namespace Vanguard\Http\Requests\User;

use Vanguard\Http\Requests\Request;
use Vanguard\User;

class CreateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.*\d)(?=.*[A-Z]).*$/',
            'birthday' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'ext' => 'required',
            'phone' => 'required',
        ];

        if ($this->get('country_id')) {
            $rules += ['country_id' => 'exists:countries,id'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'password.regex' => "Please use at least one capital letter and one number"
        ];
    }
}
