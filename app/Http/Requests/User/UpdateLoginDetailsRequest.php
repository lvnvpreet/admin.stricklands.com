<?php

namespace Vanguard\Http\Requests\User;

use Vanguard\Http\Requests\Request;
use Vanguard\User;

class UpdateLoginDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->getUserForUpdate();

        return [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'nullable|unique:users,username,' . $user->id,
            'password' => 'required|confirmed|min:6|regex:/^.*(?=.*\d)(?=.*[A-Z]).*$/',
        ];
    }

    /**
     * @return \Illuminate\Routing\Route|object|string
     */
    protected function getUserForUpdate()
    {
        return $this->route('user');
    }

    public function messages()
    {
        return [
            'password.regex' => "Please use at least one capital letter and one number"
        ];
    }
}
