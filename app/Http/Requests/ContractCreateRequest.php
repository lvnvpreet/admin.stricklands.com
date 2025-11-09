<?php

namespace Vanguard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'location'=>'required',
            'wage'=>'required',
            'position'=>'required',
            'department'=>'required',
            'start_date'=>'nullable|date_format:Y-m-d',
            'notes'=>'sometimes'
        ];
    }
}
