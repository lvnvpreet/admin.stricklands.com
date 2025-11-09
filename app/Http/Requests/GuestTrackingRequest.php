<?php

namespace Vanguard\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class GuestTrackingRequest extends FormRequest
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
            'guest_name'=>'required',
            'guest_city' => 'required',
            'guest_type' => 'required',
            'guest_used_new'=>'required|in:New,Used',
            'arrival_time'=>'required',
        ];
    }
}
