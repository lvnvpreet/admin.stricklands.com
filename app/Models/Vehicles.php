<?php

namespace Vanguard\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Vanguard\Models\VehicleSM360;

class Vehicles extends Model
{
    use FormAccessible;

    protected $table = 'vehicles';

    public $timestamps = false;


    public function logistic_notes(){
        return $this->hasMany(LogisticsNotes::class,'stock_no','fldStockNo')->orderBy('id','DESC');
    }

    public function description(){
        return $this->hasOne(Vehicledescription::class,'fldStockNo','fldStockNo')->orderBy('id','DESC');
    }

    public function location(){
        return $this->hasOne(Locations::class,'fldCode','fldLocationCode');
    }

    public function vehicle_sm(){
        return $this->hasOne(VehicleSM360::class,'stock','fldStockNo');
    }

    public function indicators(){
        return $this->hasOne(LogisticsIndicators::class,'stock_no','fldStockNo');
    }

    public function timers(){
        return $this->hasMany(LogisticsTimer::class,'stock_no','fldStockNo');
    }
    public function getTotalDaysAttribute(){
        return Carbon::parse($this->fldDateReceived)->diffInDays(Carbon::now());
    }

    public function transfer_requests(){
        return $this->hasMany(LogisticsTransferRequest::class,'user_id','id');
    }

    public function hasImages(){

        for ($i=2;$i<=60;$i++):
                $name = "/home/adminstrick/images.stricklands.com/vin/";
                $name .= $this->fldStockNo;
                $name .= "-" . $i . ".jpg";

            if(file_exists($name))
                return true;
         endfor;

        return false;
    }

    static function getImageStatistics($locationCode,$operator = '=',$statusCode = false){
	    $query = self::where('fldSoldStatus',0)
		            ->where('fldLocationCode',$operator,$locationCode)
		            ->where('fldKey1','');

	    if($statusCode){
		    $query->where('fldStatusCode','=',$statusCode);
	    }

	    $data['total'] = $query->count();
	    $data['all_without'] = 0;

	    foreach ($query->get() as $vh){
		    $name = "/home/adminstrick/images.stricklands.com/vin/";
		    $name .= $vh->fldStockNo;
		    $name .= "-1.jpg";
		    if(@GetImageSize($name)){

		    }else{
			    $data['all_without']++;
		    }
	    }
	    $data['all_with'] = $data['total'] - $data['all_without'];
	    if($data['total']){
		    $data['percent'] = round(($data['all_with']/$data['total']) * 100);
	    }else{
		    $data['percent'] = 0;
	    }


	    return $data;
    }

    public function formFldNewUsedAttribute(){

        if($this->fldStatusCode == 'N'){
            return 1;
        }else{
            return 2;
        }
    }

    public function formFldTypeAttribute(){
        return $this->getAttributeValue('fldType');
    }

    public function formFldStockAttribute(){ return $this->getAttributeValue('fldStockNo'); }
    public function formFldVinAttribute(){ return $this->getAttributeValue('fldShortVINNo'); }
    public function formFldTradeStockAttribute(){ return $this->getAttributeValue('fldStockNo'); }
    public function formFldTradeVinAttribute(){ return $this->getAttributeValue('fldShortVINNo'); }
    public function formFldYearAttribute(){ return $this->getAttributeValue('fldYear'); }
    public function formFldMakeAttribute(){ return $this->getAttributeValue('fldMake'); }
    public function formFldModelAttribute(){ return $this->getAttributeValue('fldModel'); }
    public function formFldColorAttribute(){ return $this->getAttributeValue('fldExteriorColor'); }
    public function formFldTradeYearAttribute(){ return $this->getAttributeValue('fldYear'); }
    public function formFldTradeMakeAttribute(){ return $this->getAttributeValue('fldMake'); }
    public function formFldTradeModelAttribute(){ return $this->getAttributeValue('fldModel'); }
    public function formFldTradeColourAttribute(){ return $this->getAttributeValue('fldExteriorColor'); }
    public function formFldTradeTransmissionAttribute(){ return $this->getAttributeValue('fldTransmission'); }
    public function formFldTradeTypeAttribute(){ return $this->getAttributeValue('fldFuelType'); }

    public function vehicle_data()
    {
        return $this->hasOne(VehicleData::class,'vin_no','fldVINNo');
    }

    public function getStockDaysAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s',$this->getAttributeValue('fldDateReceived'));
        return $date->diffInDays();
    }
}
