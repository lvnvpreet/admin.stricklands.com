<?php

namespace Vanguard\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'fld_tracker_type'=>'required',
            'fld_new_used'=>'required|in:1,2,3',
            'fld_type'=>'required|in:C,S,V,T',
            'fld_location'=>'required|exists:locations,id',
            'fld_on_service'=>'required|in:Yes,No',

            'fld_status'=>'required|in:OK,Delay,Alert',
            'fld_pend'=>'required|in:Yes,No',
            'fld_hdn'=>'required|in:Yes,No',
            'fld_funded'=>'required|in:Yes,No',
            's_spare'=>'nullable|in:Yes,No',

            'fld_sperson'  =>   'required|numeric|exists:user_details,id',
            'fld_points' =>   'nullable|numeric',
            'fld_sperson2' =>   'nullable|numeric|exists:user_details,id',
            'fld_points2' =>   'nullable|numeric',
            // 'fld_paid'      =>   'required|in:Yes,No',
            'fld_paid_amount'  =>   'required_if:fld_paid,Yes',
            'fld_paid_amount2' =>   'nullable',
            'fld_paid_amount_notes'     =>  'nullable',
            'fld_turn_over'     =>  'nullable|numeric|exists:user_details,id',

            'fld_customer'      => 'required|string',
            'fld_payment'      => 'required|exists:payment,code',
            'trade'      => 'nullable',

            'fld_stock'      => 'required', //|exists:vehicles,fldStockNo
            'fld_vin'      => 'nullable',

            'fld_year'  =>  'required|numeric',
            'fld_make'  =>  'required',
            'fld_model'  =>  'required',
            'fld_color'  =>  'nullable',

            'fld_details.*'   => 'nullable|in:NL,NF,NC,LOC',

            'fld_sale_date'=>'nullable|date_format:Y-m-d',
            'fld_date'=>'nullable|date_format:Y-m-d',
            'fld_time'=>'nullable|date_format:H:i:s',

            'fld_trade_year'=>'nullable|date_format:Y',
            'fld_trade_make'=>'nullable',
            'fld_trade_model'=>'nullable',
            'fld_trade_colour'=>'nullable',
            'fld_trade_mileage'=>'nullable',
            'fld_trade_vin'=>'nullable',
            'fld_trade_stock'=>'nullable',
            'fld_trade_acv'=>'nullable',
            'fld_trade_cylinder'=>'nullable|in:4,6,8,other',
            'fld_trade_transmission'=>'nullable|in:Auto,Manual',
            'fld_trade_drive'=>'nullable|in:FWD,RWD,AWD,4X4',
            'fld_trade_type'=>'nullable|in:Gas,Diesel,Hybrid,Electric',
            'fld_trade_interior'=>'nullable|in:Scrap,Dirty,Average,Clean,Pin',
            'fld_trade_exterior'=>'nullable|in:Scrap,Turd,Average,Clean,Pin',
            //'trade_options'=>'nullable|array',
            'fld_trade_options.*'=>['nullable',Rule::in(['A','C','T','CD','PW','PL','SK','KE','START','RCAM','PS','L','HS','PR','ALL','CH','NAV','BLUE','DVD','VS','TOW'])],
            'fld_trade_notes'=>'nullable',
            //'protection'=>'nullable|array',
            'protection.*'=>['nullable',Rule::in(["F.P.P","Paint","Rust","Sound","Glass","Tint x 2","Tint x 5","Interior"])],
            //'products'=>'nullable|array',
            'fld_products.*'=>['nullable',Rule::in(["L","A","G","W","*L,A,G,W","LOE"])],

            'fld_license'=>'required|in:New,Temp,Trans',
            'lisc_prep'=>'required|in:Yes,No',
            'fld_rin'=>'required|in:Yes,No',
            'file_prep'=>'required|in:Yes,No',

            'notes'=>'nullable'
        ];
    }
}
