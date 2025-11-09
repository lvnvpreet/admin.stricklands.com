<?php

namespace Vanguard\Http\Requests\User;

use Illuminate\Validation\Rule;
use Vanguard\Http\Requests\Request;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;

class UpdateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'email' => 'email|unique:users,email,' . $user->id,
            'username' => 'nullable|unique:users,username,' . $user->id,
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.*\d)(?=.*[A-Z]).*$/',
            'birthday' => 'nullable|date',
            'role_id' => 'exists:roles,id',
            'country_id' => 'exists:countries,id',
            'status' => Rule::in(array_keys(UserStatus::lists()))
        ];
    }


    public function messages()
    {
        return [
            'password.regex' => "Please use at least one capital letter and one number"
        ];
    }
}
