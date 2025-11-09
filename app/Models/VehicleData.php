<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleData extends Model
{
    protected $table = 'vehicles_data';
    protected $fillable = [
        'vin_no',
        'engine_installed',
        'engine_type',
        'displacement_ltr',
        'displacement_cubic_in',
        'horsepower_value',
        'horsepower_rpm',
        'fuel_economy_unit',
        'fuel_economy_city',
        'fuel_economy_hwy',
        'fuel_capacity',
        'engine_desc',
        'standard',
        'fuel_type',
        'styles',
    ];

    protected $casts = [
        'standard'=>'array',
        'styles'=>'array',
    ];

    public function vehicle()
    {
        return $this->belongsTo(VehicleData::class,'vin_no','fldVINNo');
    }

    /**
     * @return string
     */
    public function getDisplacementAttribute()
    {
        if($this->displacement_ltr && $this->displacement_cubic_in){
            return $this->displacement_ltr . ' / ' . $this->displacement_cubic_in;
        }elseif($this->displacement_ltr){
            return $this->displacement_ltr;
        }elseif($this->displacement_cubic_in){
            return $this->displacement_cubic_in;
        }else{
            return '';
        }
    }

    /**
     * @return string
     */
    public function getHorsepowerAttribute()
    {
        if($this->horsepower_value && $this->horsepower_rpm){
            return $this->horsepower_value . ' @ ' . $this->horsepower_rpm;
        }elseif($this->horsepower_value){
            return $this->horsepower_value;
        }elseif($this->horsepower_rpm){
            return $this->horsepower_rpm;
        }else{
            return '';
        }
    }

    public function getFuelEconomyAttribute()
    {
        if($this->fuel_economy_city && $this->fuel_economy_hwy){
            $fe = $this->fuel_economy_city . ' / ' . $this->fuel_economy_hwy;
        }elseif($this->fuel_economy_city){
            $fe = $this->fuel_economy_city;
        }elseif($this->fuel_economy_hwy){
            $fe = $this->fuel_economy_hwy;
        }else{
            $fe = '';
        }
        if(!empty($fe)) $fe .= '&nbsp;&nbsp;' . $this->fuel_economy_unit;

        return $fe;
    }
}
