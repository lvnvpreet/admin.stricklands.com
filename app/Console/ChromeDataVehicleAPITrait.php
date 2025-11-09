<?php
namespace Vanguard\Console;

use Vanguard\Models\VehicleData;
use Vanguard\Models\Vehicles;
use Vanguard\Notifications\ApiLimitExtended;
use Vanguard\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait ChromeDataVehicleAPITrait
{
    protected $maxAttempts = 1;

    protected $monthalyLimit = 1500;

    protected $logs;

    protected $errorLogs;

    protected function saveVehiclesDetails(){
        $logs = $this->getLog();
        $id_pointer = $this->getIdPointer();
        Log::info('Starting Log: Pointer - '.$id_pointer);

        if($logs->total >= $this->monthalyLimit){
            $this->sendAdminNotification();
            return ;
        }

        $errorLog = $this->getErrorLog();

        DB::enableQueryLog();
        $VINs = Vehicles::doesntHave('vehicle_data')->where('id','>',$id_pointer)->take(25)->get();
        $qLog = DB::getQueryLog();
        Storage::disk('public')->put('vehicle-query.json',json_encode($qLog,JSON_PRETTY_PRINT));
        Log::info('Content Found '.$VINs->count());
        foreach(Vehicles::where('id','>',$id_pointer)->take(25)->get() as $VIN){
            if(is_null($VIN->vehicle_data) || (!is_null($VIN->vehicle_data) && $VIN->vehicle_data->engine_desc != "")){
                continue;
            }
            if(!isset($errorLog[$VIN->fldVINNo]) || $errorLog[$VIN->fldVINNo]['attempts'] < $this->maxAttempts){
                $detail = $this->getAPIResponse($VIN->fldVINNo);
                if($detail){
                    $logs->success_count = $logs->success_count + 1;
                    $data =  $this->getUseFullDetail($detail,$VIN->fldVINNo);
                    if(isset($data['engine_desc']) && !empty($data['engine_desc'])){
                        $vehicleData = $VIN->vehicle_data;
                        $vehicleData->engine_desc = $data['engine_desc'];
                        $vehicleData->save();
                    }
                }else{
                    if(isset($errorLog[$VIN->fldVINNo])){
                        $errorLog[$VIN->fldVINNo] = [
                            'attempts' => $errorLog[$VIN->fldVINNo]['attempts'] + 1,
                            'last_try' => time()
                        ];
                    }else{
                        $errorLog[$VIN->fldVINNo] = [
                            'attempts' => 1,
                            'last_try' => time()
                        ];
                    }

                    $logs->error_count = $logs->error_count + 1;
                }
            }

            $id_pointer = $VIN->id;
            $logs->total = $logs->total + 1;
            $logs->last_api_call = "Time : ". date('Y-m-d h:i:s') . " VIN No. :" .$VIN->fldVINNo;

            $this->putLog($logs);
            Storage::disk('public')->put('id_pointer.txt',$id_pointer);
        }
        foreach ($VINs as $VIN){
            //return if vehicle data exists
            if(VehicleData::where('vin_no',$VIN->fldVINNo)->exists()) continue;

            if(!isset($errorLog[$VIN->fldVINNo]) || $errorLog[$VIN->fldVINNo]['attempts'] < $this->maxAttempts){

                $detail = $this->getAPIResponse($VIN->fldVINNo);
                //$detail = $this->getResponseByVin($VIN->fldVINNo);

                if($detail){
                    $logs->success_count = $logs->success_count + 1;
                    $data =  $this->getUseFullDetail($detail,$VIN->fldVINNo);
                    $VehicleData = VehicleData::create($data);
                }else{
                    if(isset($errorLog[$VIN->fldVINNo])){
                        $errorLog[$VIN->fldVINNo] = [
                            'attempts' => $errorLog[$VIN->fldVINNo]['attempts'] + 1,
                            'last_try' => time()
                        ];
                    }else{
                        $errorLog[$VIN->fldVINNo] = [
                            'attempts' => 1,
                            'last_try' => time()
                        ];
                    }

                    $logs->error_count = $logs->error_count + 1;
                }
            }

            $id_pointer = $VIN->id;
            $logs->total = $logs->total + 1;
            $logs->last_api_call = "Time : ". date('Y-m-d h:i:s') . " VIN No. :" .$VIN->fldVINNo;

            $this->putLog($logs);
            Storage::disk('public')->put('id_pointer.txt',$id_pointer);
        }

        Storage::disk('public')->put('api-error-list.json',json_encode($errorLog,JSON_PRETTY_PRINT));
    }


    //for testing and only for development purpose
    private function test()
    {
        $vd = VehicleData::all();
        foreach ($vd as $v){
            dump($v->toArray(),$this->getResponseByVin($v->vin_no));
        }
        die();
    }

    //for testing and only for development purpose
    public function getResponseByVin($vin)
    {
        if(Storage::disk('public')->exists("response/$vin.xml")){
            $stringResponse = Storage::disk('public')->get("response/$vin.xml");
            $start = strpos($stringResponse, "<S:Body>") + 8;
            $end = strrpos($stringResponse, "</S:Body>");
            $stringResponse = substr($stringResponse, $start, $end - $start);
            $doc = simplexml_load_string($stringResponse);
            return $doc;
        }else{
            return false;
        }
    }


    protected function getErrorLog()
    {
        if(Storage::disk('public')->exists('api-error-list.json')){
            $errorLog =  json_decode(Storage::disk('public')->get('api-error-list.json'),true);
            return ($errorLog)?: [];
        }else{
            return [];
        }
    }

    /**
     * Get Log information about api
     * @return object
     */
    protected function getLog()
    {
        $prefix = date('m-y-');
        if(Storage::disk('public')->exists($prefix.'chromedata.json')){
            Log::info($prefix.'chromedata.json File Exists');
            return json_decode(Storage::disk('public')->get($prefix.'chromedata.json'));
        }else{
            Log::info($prefix.'chromedata.json File Not Exists');

            return (object) [
                'success_count'=>0,
                'error_count'=>0,
                'total'=>0,
                'last_api_call'=>'',
            ];
        }
    }

    protected function putLog($log)
    {
        $prefix = date('m-y-');
        Storage::disk('public')->put($prefix.'chromedata.json',json_encode($log,JSON_PRETTY_PRINT));
    }

    protected function getIdPointer()
    {
        if(Storage::disk('public')->exists('id_pointer.txt')){
            $pointer = Storage::disk('public')->get('id_pointer.txt');
            return intval($pointer);
        }
        return 0;

    }


    protected function getAPIResponse($VINnum)
    {
        $xmlSoapRequest = $this->createSoapRequest($VINnum);

        $soapURL ="http://services.chromedata.com/Description/7a";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $soapURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlSoapRequest);
        $header[] = "SOAPAction: ". "";
        $header[] = "MIME-Version: 1.0";
        $header[] = "Content-type: text/xml; charset=utf-8";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        Storage::disk('public')->put('response/'.$VINnum.'.xml',$result);
        $response = $this->parseSoapRequest($result);
        if($response && $response->responseStatus["responseCode"] == "Successful"){
            return $response;
        }else{
            $this->logErrorResponse($VINnum,$xmlSoapRequest,$result);
            return false;
        }
    }

    /**
     * @param $VINnum string
     * @return string
     */
    protected function createSoapRequest($VINnum)
    {
        $request = '
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:description7a.services.chrome.com">
               <soapenv:Header/>
               <soapenv:Body>
                  <urn:VehicleDescriptionRequest>
                     <urn:accountInfo number="301489" secret="75f98be7bc454d06" country="CA" language="en" behalfOf="?"/>
                     <urn:vin>' . $VINnum . '</urn:vin>
                  </urn:VehicleDescriptionRequest>
               </soapenv:Body>
            </soapenv:Envelope>
            ';
        return $request;
    }

    /**
     * @param $stringResponse string
     * @return bool|\SimpleXMLElement
     */
    protected function parseSoapRequest($stringResponse)
    {
        $start = strpos($stringResponse, "<S:Body>") + 8;
        $end = strrpos($stringResponse, "</S:Body>");
        if (($start <= 0) || ($end <= 0)) {
            return false;
            //echo("<!--\n\n" . $result . "\n\n-->\n");
            //die("Response returned from '$soapURL' doesn't appear to be a SOAP document.");
        }
        $stringResponse = substr($stringResponse, $start, $end - $start);
        $doc = simplexml_load_string($stringResponse);
        return $doc;
    }

    /**
     * @param $VINnum string
     * @param $request string
     * @param $response string
     */
    protected function logErrorResponse($VINnum,$request,$response)
    {
        $log = "\n\n/*******".date('Y-m-d h:i:s')."***************/\nFailed request for VIN number = `" . $VINnum."`   \n";
        $log .= "/***** xmlRequest ********/\n";
        $log .= "\n$request\n";
        $log .= "/***** API response ********/\n";
        $log .= "\n$response\n";
        Storage::disk('public')->put('chromedata-error-response/'.$VINnum.'.json',$log);
    }

    protected function getUseFullDetail($SimpleXMLElement,$vin)
    {
       //dd((string) $SimpleXMLElement->engine->installed['cause']) ;
        $array = [
            'vin_no'    =>  $vin,
            'engine_installed'=> (string) $SimpleXMLElement->engine->installed['cause'],
            'engine_type'=> (string) $SimpleXMLElement->engine->engineType,
            'fuel_type'=> (string) $SimpleXMLElement->engine->fuelType
        ];

        return array_merge($array,
            $this->getDisplacment($SimpleXMLElement->engine),
            $this->getHorsepower($SimpleXMLElement->engine),
            $this->getFuelEconomy($SimpleXMLElement->engine),
            $this->getFuelCapacity($SimpleXMLElement->engine),
            $this->getMechanicalDetail($SimpleXMLElement),
            $this->getStyles($SimpleXMLElement)
            );
    }

    protected function getDisplacment($engine)
    {
        //shown as `Displacement L/CI` ==>  `Displacement displacement_ltr/displacement_cubic_in`
        $displacement = ['displacement_ltr'=>'','displacement_cubic_in'=>''];
        if(!is_null($engine->displacement)){
            $displacement['displacement_ltr'] = (string) $engine->displacement['liters'];
            $displacement['displacement_cubic_in'] = (string) $engine->displacement['cubicIn'];
        }
        return $displacement;
    }

    protected function getHorsepower($engine)
    {
        //Shown as `Horsepower` => `horsepower_value/horsepower_rpm`
        $housepower = ['horsepower_value'=>'','horsepower_rpm'=>''];
        if(!is_null($engine->horsepower)){
            $housepower['horsepower_value'] = (string) $engine->horsepower['value'];
            $housepower['horsepower_rpm'] = (string) $engine->horsepower['rpm'];
        }
        return $housepower;
    }

    protected function getFuelEconomy($engine)
    {
        //Shown as `Fuel Economy city/hwy unit`
        $fuel_economy = ['fuel_economy_unit'=>'','fuel_economy_city'=>'','fuel_economy_hwy'=>''];
        if(!is_null($engine->fuelEconomy)){
            $city = $engine->fuelEconomy->city;
            $hwy = $engine->fuelEconomy->hwy;
            $fuel_economy['fuel_economy_unit'] = (string) $engine->fuelEconomy['unit'];
            $fuel_economy['fuel_economy_city'] = ((float)$city['high'] == (float)$city['low']) ? (float) $city['low'] : (string) $city['low'] . ' - '. (string) $city['high'];
            $fuel_economy['fuel_economy_hwy'] = ((float) $hwy['high'] == (float) $hwy['low']) ? (string) $hwy['low'] : (string) $hwy['low'] . ' - '. (string) $hwy['high'];
        }
        return $fuel_economy;
    }

    protected function getFuelCapacity($engine)
    {
        $fuel_capacity = '';
        if(!is_null($engine->fuelCapacity)){
            $fuel_capacity = ((float) $engine->fuelCapacity['high'] == (float) $engine->fuelCapacity['low']) ? (string) $engine->fuelCapacity['low'] : (string) $engine->fuelCapacity['low'] . ' - ' . (string) $engine->fuelCapacity['high'];
            $fuel_capacity .= ' ' . (string) $engine->fuelCapacity['unit'];
        }
        return ['fuel_capacity'=>$fuel_capacity];
    }

    protected function getMechanicalDetail($SimpleXMLElement )
    {
        $data = ['engine_desc'=>'','standard'=>[]];
        $skipped_string    =   ['Full Tank of Fuel & Floor Mats','Full Tank of Fuel & Floor Mats -inc: installed block heater cord'];
        if(!is_null($SimpleXMLElement->standard)){
            foreach($SimpleXMLElement->standard as $standard)
            {
                if(!in_array($standard->description,$skipped_string)) {
                    if ((string)$standard->header == "MECHANICAL" && (string)$standard->installed['cause'] == 'Engine') {
                        $data['engine_desc'] = (string)$standard->description;
                    } else {
                        $key = (string)$standard->header;
                        if (!array_key_exists($key, $data['standard'])) $data['standard'][$key] = [];
                        $data['standard'][$key][] = (string)$standard->description;

                    }
                }
            }
        }
        return $data;
    }

    protected function getStyles($SimpleXMLElement)
    {
        $styles = [];
        if(!is_null($SimpleXMLElement->style)){
            foreach ($SimpleXMLElement->style as $style)
            {
                $styles[] = ['style_id'=>(string) $style['id'],'model'=>(string) $style->model,'trim'=>(string) $style['trim']];
            }
        }
        return ['styles'=>$styles];
    }


    protected function sendAdminNotification()
    {
        $admin = User::where('email','flennon@stricklands.com')->first();
        $admin->notify(new ApiLimitExtended());
    }

    protected function cleanLogs()
    {
        $log = [
            'id_pointer'=>0,
            'success_count'=>0,
            'error_count'=>0,
            'total'=>0,
            'last_api_call'=>'',
        ];
        Storage::disk('public')->put('chromedata.json',json_encode($log,JSON_PRETTY_PRINT));

        Storage::disk('public')->put('api-error-list.json',json_encode([],JSON_PRETTY_PRINT));

    }

    public function importVechicleSM(){
        
        $file = "https://feeds.stricklands.com/sm360/inventory_en.csv";
        
        $theCSV = array_map('str_getcsv', file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        array_walk($theCSV, function(&$ary) use($theCSV) {
            $ary = array_combine($theCSV[0], $ary);
        });
        array_shift($theCSV);
        
        $csvData = collect($theCSV);
        foreach($csvData as $data){
            try{
                \Vanguard\Models\VehicleSM360::updateOrCreate(['vin' => $data['vin']], $data);
            }catch(\Exception $e){
                \Log::error($e->getMessage());
            }
        }
    }
}
