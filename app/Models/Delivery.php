<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Vanguard\User;


class Delivery extends Model
{
    use FormAccessible;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'delivery';
    
    protected $date = 'fld_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fld_tracker_type','fld_new_used','fld_type','fld_location','fld_on_service','fld_status','fld_pend','fld_hdn',
        'fld_funded','s_spare','fld_sperson','fld_sperson2','fld_paid','fld_paid_amount','fld_paid_amount2','fld_paid_amount_notes',
        'fld_turn_over','fld_customer','fld_payment','trade','fld_stock','fld_vin','fld_year','fld_make','fld_model','fld_color',
        'fld_details','fld_sale_date','fld_date','fld_time','fld_trade_year','fld_trade_make','fld_trade_model','fld_trade_colour',
        'fld_trade_mileage','fld_trade_vin','fld_trade_userid','fld_trade_trim','fld_trade_cost','fld_trade_status','fld_trade_retail','fld_display_trade','fld_trade_stocks','fld_trade_stock','fld_trade_acv','fld_trade_cylinder','fld_trade_transmission',
        'fld_trade_drive','fld_trade_type','fld_trade_interior','fld_trade_exterior','fld_trade_options','fld_trade_notes',
        'protection','fld_products','fld_license','lisc_prep','fld_rin','file_prep','notes','s_w_o','s_p_tech','s_tech',
        's_emmision','s_safe','s_recheck','fld_notes','al_notes','d_who','d_w_o','d_keys','d_complete','d_time','fld_posted', 'fld_trade_year2', 'fld_trade_make2', 'fld_trade_model2', 'fld_trade_colour2', 'fld_trade_mileage2', 'fld_trade_vin2', 'fld_trade_stock2', 'fld_trade_acv2', 'fld_trade_cylinder2', 'fld_trade_transmission2', 'fld_trade_type2', 'fld_trade_interior2', 'fld_trade_exterior2', 'fld_trade_options2','trade_manager_acv','trade_manager_acv2'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fld_details'=>'array',
        'fld_trade_options'=>'array',
        'protection'=>'array',
        'fld_products'=>'array',
        'fld_trade_options2'=>'array',
    ];

    public $timestamps = false;

    public function userdetail()
    {
        return $this->belongsTo(Userdetails::class,'fld_sperson','id');
    }

    public function trade_user(){
        return $this->belongsTo(User::class,'fld_trade_userid','id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'fld_payment','code');
    }

    public function saleperson(){
        return $this->belongsTo(Userdetails::class,'fld_sperson','id');
    }
    public function saleperson2(){
        return $this->belongsTo(Userdetails::class,'fld_sperson2','id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class,'fld_location','fldLocation');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class,'fld_stock','fldStockNo');
    }

    public function getTblBgColorAttribute(){
        $color = date('D',strtotime($this->getAttributeValue('fld_date')));
        switch ($color){
            case 'Sun':
                return "#FCFAE8";
                break;
            case 'Mon':
                return "";
                break;
            case 'Tue':
                return "#EAEBFB";
                break;
            case 'Wed':
                return "#F9EDEB";
                break;
            case 'Thu':
                return "#FCFAE8";
                break;
            case 'Fri':
                return "#EFF5F5";
                break;
            case 'Sat':
                return "#f5f5f5";
                break;
            default:
                return "#fafbfc";
        }
    }

    public function getTdOptionsAttribute(){

        return (array)$this->getAttribute('fld_trade_options');
    }

}
