<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Vanguard\Models\Delivery;
use Vanguard\Models\Locations;
use Vanguard\Models\Userdetails;
use Vanguard\Models\Vehicles;
use Vanguard\User;
use Yajra\DataTables\Facades\DataTables;

class SalesTrackingController extends Controller
{
    /**
     * SalesTrackingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('ListSalestracking');
    }

    public function index(Locations $location, Request $request){


        $CurrentUser = auth()->user()->details;


        $stricklandTarget   =   Locations::find(100);
        // $combinedLocation   =   Locations::find(1);

        // $combinedLocationTotal   =   Delivery::where('fld_date','>=',$stricklandTarget->day_start)
        //     ->where('s_spare','No')
        //     ->where('fld_tracker_type','1')
        //     ->whereIn('fld_new_used',['2','3'])
        //     ->whereIn('fld_location',['1'])
        //     ->get();



        $TotalDeliveryOfLocation = Delivery::where('fld_date','>=',$stricklandTarget->day_start)
            ->where('s_spare','No')
            ->where('fld_location',$location->id);

        $TotalDeliveryOfLocation2   =   Delivery::where('s_spare','No')
            ->where('fld_location',$location->id);


        if($location->id==8){
            $TotalDeliveryOfLocation->where('fld_tracker_type','<>',13);
            $TotalDeliveryOfLocation2->where('fld_tracker_type','<>',13);
        }

        $TotalDeliveryOfLocation     =   $TotalDeliveryOfLocation->get();
        $TotalDeliveryOfLocation2    =   $TotalDeliveryOfLocation2->get();

        $data = [
            'new'=>[
                'users'=>[],
            ],
            'used'=>[
                'users'=>[],
            ]
        ];
        $pendingData = [
            'new'=>[
                'users'=>[],
            ],
            'used'=>[
                'users'=>[]
            ]
        ];

        $TotalDeliveryOfLocation->map(function($delivery) use (&$data,&$pendingData){
            
            // $status = ($delivery->fld_new_used == 1) ? "new" : "used";
            $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";

            if($delivery->fld_new_used == 1){
                $status = "new";
            }elseif($delivery->fld_new_used == 2){
                $status = "used";
            }elseif($delivery->fld_new_used == 3){
                $status = "used";
                if(!isset($$varName[$status]['buys'][$delivery->fld_sperson])){
                    $$varName[$status]['buys'][$delivery->fld_sperson]  =   0;
                }
                $$varName[$status]['buys'][$delivery->fld_sperson] =  (int) $$varName[$status]['buys'][$delivery->fld_sperson]+1;
            }
            if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
                $$varName[$status]['users'][$delivery->fld_sperson] = 0;
            }
            if($delivery->fld_new_used == 2 || $delivery->fld_new_used == 1){
                if($delivery->fld_sperson2){
                    if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
                        $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
                    }
                    $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
                    $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
                }else{
                    $$varName[$status]['users'][$delivery->fld_sperson] += 1;
                }
            }
        });



        /*$TotalDeliveryOfLocation2->map(function($delivery) use (&$pendingData,&$data){
            
            // $status = ($delivery->fld_new_used == 1) ? "new" : "used";
            $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";
            if($delivery->fld_new_used == 1){
                $status = "new";
            }elseif($delivery->fld_new_used == 2){
                $status = "used";
            }elseif($delivery->fld_new_used == 3){
                $status = "used";
                if(!isset($$varName[$status]['buys'][$delivery->fld_sperson])){
                    $$varName[$status]['buys'][$delivery->fld_sperson]  =   0;
                }
                $$varName[$status]['buys'][$delivery->fld_sperson] =  (int) $$varName[$status]['buys'][$delivery->fld_sperson]+1;
            }
            if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
                $$varName[$status]['users'][$delivery->fld_sperson] = 0;
            }

            if($delivery->fld_new_used == 2 || $delivery->fld_new_used == 1){
                if($delivery->fld_sperson2){
                    if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
                        $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
                    }
                    $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
                    $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
                }else{
                    $$varName[$status]['users'][$delivery->fld_sperson] += 1;
                }
            }
        });*/

        // if($location->id==5){
        //     $combinedLocationTotal->map(function($delivery) use (&$data,&$pendingData){

        //         //$status = ($delivery->fld_new_used == 1) ? "new" : "used";
        //         $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";
        //         if($delivery->fld_new_used == 1){
        //             $status = "new";
        //         }elseif($delivery->fld_new_used == 2){
        //             $status = "used";
        //         }elseif($delivery->fld_new_used == 3){
        //             $status = "used";
        //             if(!isset($$varName[$status]['buys'][$delivery->fld_sperson])){
        //                 $$varName[$status]['buys'][$delivery->fld_sperson]  =   0;
        //             }
        //             $$varName[$status]['buys'][$delivery->fld_sperson] = (int) $$varName[$status]['buys'][$delivery->fld_sperson]+ 1;
        //         }

        //         if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
        //             $$varName[$status]['users'][$delivery->fld_sperson] = 0;
        //         }

        //         if($delivery->fld_new_used == 2 || $delivery->fld_new_used == 1){

        //             if($delivery->fld_sperson2){
        //                 if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
        //                     $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
        //                 }
        //                 $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
        //                 $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
        //             }else{
        //                 $$varName[$status]['users'][$delivery->fld_sperson] += 1;
        //             }

        //         }

        //     });
        // }

        /*if($location->id==5){
            $data['new']['total'] = $TotalDeliveryOfLocation->where('fld_funded','Yes')->where('fld_new_used',1)->count();
            $data['used']['total'] = $combinedLocationTotal->where('fld_funded','Yes')->count();

            $pendingData['new']['total'] = $TotalDeliveryOfLocation2->where('fld_funded','No')->where('fld_new_used',1)->count();
            $pendingData['used']['total'] = $combinedLocationTotal->where('fld_funded','No')->count();


        }else{*/

            $house = Userdetails::where('fld_usr_location',$location->id)->where('fld_usr_lastname','House')->first();
            $users = Userdetails::whereIn('fld_usr_location',[$location->id,'1','5'])
                ->where('fld_usr_cat',3)
                ->where('fld_usr_lastname', '<>', 'House')
                ->orderBy('fld_usr_target','DESC')
                ->get();
            foreach($data as $type => $u){
                if(isset($u['users'])){
                    foreach ($u['users'] as $user_id => $user){
                        if($house && $house->id==$user_id) continue;

                        if(!$users->where('id',$user_id)->first()){
                            unset($data[$type]['users'][$user_id]);
                        }
                    }
                }
            }

            foreach($pendingData as $type => $u){
                if(isset($u['users'])){
                    foreach ($u['users'] as $user_id => $user){
                        if($house && $house->id==$user_id) continue;
                        if(!$users->where('id',$user_id)->first()){
                            unset($pendingData[$type]['users'][$user_id]);
                        }
                    }
                }
            }
            $data['new']['total']   = array_sum($data['new']['users']);
            $data['used']['total']  = array_sum($data['used']['users']);
            $data['buys']['total']  = (isset($data['used']['buys']) && $data['used']['buys'] > 0) ? array_sum($data['used']['buys']) : 0;
            $pendingData['new']['total'] = array_sum($pendingData['new']['users']);
            $pendingData['used']['total'] = array_sum($pendingData['used']['users']);
            $pendingData['buys']['total'] = (isset($pendingData['used']['buys']) && $pendingData['used']['buys'] > 0) ? array_sum($pendingData['used']['buys']) : 0;

            //dd($data,$pendingData,$users);

        //}


        arsort ($data['used']['users']);
        arsort ($data['new']['users']);
        arsort ($pendingData['used']['users']);
        arsort ($pendingData['new']['users']);



        foreach ($users as $user){
            if(!array_key_exists($user->id,$data['new']['users'])){
                $data['new']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$data['used']['users'])){
                $data['used']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$pendingData['new']['users'])){
                $pendingData['new']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$pendingData['used']['users'])){
                $pendingData['used']['users'][$user->id] = 0;
            }
        }
        

        return view('sales-tracking.index',compact('location','stricklandTarget','users','data','CurrentUser','pendingData','house'));

    }


    public function ListSalestracking(Locations $location, Request $request){


        $CurrentUser = auth()->user()->details;

        $stricklandTarget   =   Locations::find(100);
        $combinedLocation   =   Locations::find(1);

        $combinedLocationTotal   =   Delivery::where('fld_date','>=',$stricklandTarget->day_start)
            ->where('s_spare','No')
            ->where('fld_tracker_type','1')
            ->where('fld_new_used','2')
            ->whereIn('fld_location',['1','5'])
            ->get();



        $TotalDeliveryOfLocation = Delivery::where('fld_date','>=',$stricklandTarget->day_start)
            ->where('s_spare','No')
            ->where('fld_location',$location->id)
            ->get();

        $TotalDeliveryOfLocation2   =   Delivery::where('s_spare','No')
            ->where('fld_location',$location->id)
            ->get();

        $data = [
            'new'=>[
                'users'=>[],
            ],
            'used'=>[
                'users'=>[],
            ]];
        $pendingData = [
            'new'=>[
                'users'=>[],
            ],
            'used'=>[
                'users'=>[],
            ]
        ];





        $TotalDeliveryOfLocation = $TotalDeliveryOfLocation->map(function($delivery) use (&$data){

            $status = ($delivery->fld_new_used == 1) ? "new" : "used";
            $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";

            if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
                $$varName[$status]['users'][$delivery->fld_sperson] = 0;
            }

            if($delivery->fld_sperson2){
                if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
                    $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
                }
                $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
                $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
            }else{
                $$varName[$status]['users'][$delivery->fld_sperson] += 1;
            }
        });



        $TotalDeliveryOfLocation2->map(function($delivery) use (&$pendingData){

            $status = ($delivery->fld_new_used == 1) ? "new" : "used";
            $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";

            if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
                $$varName[$status]['users'][$delivery->fld_sperson] = 0;
            }


            if($delivery->fld_sperson2){
                if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
                    $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
                }
                $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
                $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
            }else{
                $$varName[$status]['users'][$delivery->fld_sperson] += 1;
            }
        });

        if($location->id==5){
            $combinedLocationTotal->map(function($delivery) use (&$data,&$pendingData){

                $status = ($delivery->fld_new_used == 1) ? "new" : "used";
                $varName = ($delivery->fld_funded == 'No') ? "pendingData" : "data";

                if(!isset($$varName[$status]['users'][$delivery->fld_sperson])){
                    $$varName[$status]['users'][$delivery->fld_sperson] = 0;
                }


                if($delivery->fld_sperson2){
                    if(!isset($$varName[$status]['users'][$delivery->fld_sperson2])){
                        $$varName[$status]['users'][$delivery->fld_sperson2] = 0;
                    }
                    $$varName[$status]['users'][$delivery->fld_sperson2] += 0.5;
                    $$varName[$status]['users'][$delivery->fld_sperson] += 0.5;
                }else{
                    $$varName[$status]['users'][$delivery->fld_sperson] += 1;
                }
            });
        }


        /*if($location->id==5){
            $data['new']['total'] = $TotalDeliveryOfLocation->where('fld_funded','Yes')->where('fld_new_used',1)->count();
            $data['used']['total'] = $combinedLocationTotal->where('fld_funded','Yes')->count();

            $pendingData['new']['total'] = $TotalDeliveryOfLocation2->where('fld_funded','No')->where('fld_new_used',1)->count();
            $pendingData['used']['total'] = $combinedLocationTotal->where('fld_funded','No')->count();


        }else{*/

        $data['new']['total']   = array_sum($data['new']['users']);
        $data['used']['total']  = array_sum($data['used']['users']);

        $pendingData['new']['total'] = array_sum($pendingData['new']['users']);
        $pendingData['used']['total'] = array_sum($pendingData['used']['users']);

        //}


        arsort ($data['used']['users']);
        arsort ($data['new']['users']);
        arsort ($pendingData['used']['users']);
        arsort ($pendingData['new']['users']);

        $users = Userdetails::whereIn('fld_usr_location',[$location->id,'1','5'])
            ->where('fld_usr_cat',3)
            ->where('fld_usr_lastname', '<>', 'House')
            ->orderBY('fld_usr_target','DESC')
            ->get();

        foreach ($users as $user){
            if(!array_key_exists($user->id,$data['new']['users'])){
                $data['new']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$data['used']['users'])){
                $data['used']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$pendingData['new']['users'])){
                $pendingData['new']['users'][$user->id] = 0;
            }

            if(!array_key_exists($user->id,$pendingData['used']['users'])){
                $pendingData['used']['users'][$user->id] = 0;
            }
        }
        $house = Userdetails::where('fld_usr_location',$location->id)->where('fld_usr_lastname','House')->first();

        return view('sales-tracking.list-sales-tracking',compact('combinedLocation','location','stricklandTarget','users','data','CurrentUser','pendingData','house'));


    }

    public function updateTarget(Request $request){
        $this->validate($request,[
            'day_num'=>'required|numeric',
            'days_total'=>'required|numeric',
            'day_start'=>'required|date_format:Y-m-d'
        ]);

        $target = Locations::find(100);
        $target->day_num = $request->day_num;
        $target->days_total = $request->days_total;
        $target->day_start = $request->day_start;
        $target->save();

        return redirect()->back()->withSuccess(trans('success.update-sales-target'));
    }

    public function updateLocationTarget(Request $request,Locations $location){
        $this->validate($request,[
            'fldStoreTarget'=>'required|numeric',
            'fldStoreNewTarget'=>'required|numeric'
        ]);

        $location->fldStoreTarget = $request->fldStoreTarget;
        $location->fldStoreTarget = $request->fldStoreTarget;
        $location->save();
        return redirect()->back()->withSuccess(trans('success.update-location-target',['location'=>$location->fldLocationName]));
    }

    public function updateSalsemanTarget(Request $request){
        $this->validate($request,[
            'used_target'=>'required|numeric',
            'user_id'=>'required|numeric|exists:user_details,id'
        ]);

        $user = Userdetails::findOrFail($request->user_id);
        $user->fld_usr_target = $request->used_target;

        if($request->has('new_target'))
            $user->fld_new_target = $request->new_target;

        $user->save();

        return redirect()->back()->withSuccess(trans('success.update-location-target',['location'=>$user->full_name]));
    }

    public function vehicleList(Locations $location,Request $request){
        $currentUser = auth()->user();
        $stricklandTarget = Locations::where('id',100)->first();

        $vehiclesQuery = Delivery::where('s_spare','No');

        $vehiclesQuery->whereHas('saleperson',function($query) use ($location) {
            // if($location->id==1 || $location->id==5){
            //     $query->whereIn('fld_usr_location',[1,5]);
            // }else{
            //     $query->where('fld_usr_location',$location->id);
            // }
            $query->where('fld_usr_location',$location->id);

        });

        if($location->id==8){
            $vehiclesQuery->where('fld_tracker_type','<>',13);
        }

        if($request->has('wholesale') && $request->wholesale == 'Yes'){
            $vehiclesQuery->where('fld_tracker_type',2);
        }

        if($request->has('fleet') && $request->fleet == 'Yes'){
            $vehiclesQuery->where('fld_tracker_type',3);
        }


        if($request->has('funded')){
            if($request->funded == 'Yes'){
                $vehiclesQuery->where('fld_funded','Yes');
            }
            if($request->funded == 'No'){
                $vehiclesQuery->where('fld_funded','No');
            }
            if(!$request->has('fleet') && !$request->has('wholesale')){
                $vehiclesQuery->where('fld_tracker_type','<>',2);
            }
        }
        
        $vehiclesQuery->where('fld_date','>=',$stricklandTarget->day_start);



        if($currentUser->details->fld_usr_cat == 3 || $request->has('emp_id')){
            $empId = $request->has('emp_id') ? $request->get('emp_id') : $currentUser->details->id;
            $employee = Userdetails::find($empId);
            $vehiclesQuery->where(function($query) use ($empId) {
                return $query->where('fld_sperson',$empId)
                    ->orWhere('fld_sperson2',$empId);
            });


            $total = [
                'new'=>[
                    'complete' => (clone $vehiclesQuery)->where('fld_new_used',1)->where('fld_funded','Yes')->whereNull('fld_sperson2')->count(),
                    'pending'   => (clone $vehiclesQuery)->where('fld_new_used',1)->where('fld_funded','Yes')->whereNotNull('fld_sperson2')->count()/2,
                ],
                'used'=>[
                    'complete'  =>  (clone $vehiclesQuery)->where('fld_new_used',2)->where('fld_funded','Yes')->whereNull('fld_sperson2')->count(),
                    'pending'   =>  (clone $vehiclesQuery)->where('fld_new_used',2)->where('fld_funded','Yes')->whereNotNull('fld_sperson2')->count()/2,
                ]
            ];
        }else{
            $total = [
                'new'=>[
                    'complete'=> (clone $vehiclesQuery)->where('fld_new_used',1)->where('fld_funded','Yes')->count() ,
                    'pending'=> (clone $vehiclesQuery)->where('fld_new_used',1)->where('fld_funded','No')->count() ,
                ],
                'used'=>[
                    'complete'=> (clone $vehiclesQuery)->where('fld_new_used',2)->where('fld_funded','Yes')->count() ,
                    'pending'=> (clone $vehiclesQuery)->where('fld_new_used',2)->where('fld_funded','No')->count() ,
                ]
            ];
            $employee = null;
        }
        $new = (clone $vehiclesQuery)->where('fld_new_used',1)->with('saleperson','saleperson2')->get();
        $used = (clone $vehiclesQuery)->where('fld_new_used',2)->with('saleperson','saleperson2')->get();

        //dd($new);
        //dd($location);
        return view('sales-tracking.vehicle-list',compact('total','new','used','location','currentUser','employee'));
    }

    public function salesSummary($type,Request $request){
        $currentUser = auth()->user();
        $stricklandTarget = Locations::find(100);
        $used_extended_var = $stricklandTarget->days_total/$stricklandTarget->day_num;

        $automart = Locations::find(1);
        $automart_retail_del = $this->getSummaryCountDel($stricklandTarget->day_start,1,$type,2);
        $automart_percentage = round((($automart_retail_del/$automart->fldStoreTarget) * 100));
        $automart_retail_sold = $this->getSummaryCountSold($stricklandTarget->day_start,1,$type,2);


        $toyata = Locations::find(5);
        $toyota_used_del = $this->getSummaryCountDel($stricklandTarget->day_start,5,$type,2);
        $toyota_percentage = $toyata->fldStoreTarget ? round(($toyota_used_del/$toyata->fldStoreTarget) * 100) : 0;
        $toyota_used = $this->getSummaryCountSold($stricklandTarget->day_start,5,$type,2);

        $toyota_new_del =  $this->getSummaryCountDel($stricklandTarget->day_start,5,$type,1);
        $toyota_new_percentage = round(($toyota_new_del/$toyata->fldStoreNewTarget) * 100);
        $toyota_new_sold = $this->getSummaryCountSold($stricklandTarget->day_start,5,$type,1);

        $windsor = Locations::find(2);
        $windsor_retail_del = $this->getSummaryCountDel($stricklandTarget->day_start,2,$type,2);
        $windsor_percentage = round(($windsor_retail_del/$windsor->fldStoreTarget) * 100);
        $windsor_sold = $this->getSummaryCountSold($stricklandTarget->day_start,2,$type,2);

        $brantford = Locations::find(8);
        $brantford_retail_del = $this->getSummaryCountDel($stricklandTarget->day_start,8,$type,2);
        $brantford_percentage = round(($brantford_retail_del/$brantford->fldStoreTarget) * 100);
        $brantford_sold = $this->getSummaryCountSold($stricklandTarget->day_start,8,$type,2);

        $brantford_new_del = $this->getSummaryCountDel($stricklandTarget->day_start,8,$type,1);
        $brantford_new_percentage = round(($brantford_new_del/$brantford->fldStoreNewTarget) * 100);
        $brantford_new_sold = $this->getSummaryCountSold($stricklandTarget->day_start,8,$type,1);

        $stratford_fleet = Delivery::where('fld_date','>=',$stricklandTarget->day_start)->where('s_spare','No')->where('fld_tracker_type',3)->where('fld_location',5);
        if($type == 'posted'){
            $stratford_fleet->where('fld_posted','Yes');
        }
        $stratford_fleet = $stratford_fleet->count();

        $brantford_fleet = Delivery::where('fld_date','>=',$stricklandTarget->day_start)->where('s_spare','No')->where('fld_tracker_type',3)->where('fld_location',8);
        if($type == 'posted'){
            $brantford_fleet->where('fld_posted','Yes');
        }
        $brantford_fleet = $brantford_fleet->count();

        $automart_wholesale = Delivery::where('fld_date','>=',$stricklandTarget->day_start)->where('s_spare','No')->where('fld_tracker_type',2)->where('fld_new_used',2)->where('fld_location',1);
        if($type == 'posted'){
            $automart_wholesale->where('fld_posted','Yes');
        }
        $automart_wholesale = $automart_wholesale->count();

        $windsor_wholesale = Delivery::where('fld_date','>=',$stricklandTarget->day_start)->where('s_spare','No')->where('fld_tracker_type',2)->where('fld_new_used',2)->where('fld_location',2);
        if($type == 'posted'){
            $windsor_wholesale->where('fld_posted','Yes');
        }
        $windsor_wholesale = $windsor_wholesale->count();



        return view('sales-tracking.sales-summary',compact('type','used_extended_var',
            'stricklandTarget',
            'currentUser',
            'automart','automart_retail_del','automart_percentage','automart_retail_sold',
            'toyata','toyota_used_del','toyota_percentage','toyota_used',
            'toyota_new_del','toyota_new_percentage','toyota_new_sold',
            'windsor','windsor_retail_del','windsor_percentage','windsor_sold',
            'brantford','brantford_retail_del','brantford_percentage','brantford_sold',
            'brantford_new_del','brantford_new_percentage','brantford_new_sold',
            'stratford_fleet','brantford_fleet','automart_wholesale','windsor_wholesale'
        ));
    }


    protected function getSummaryCountDel($start_date,$location_id,$type,$newUsed = 2){
        $query = Delivery::where('s_spare','No')->where('fld_new_used',$newUsed)->where('fld_funded','Yes')->where('fld_date','>=',$start_date)
            ->where('fld_tracker_type',1)->where('fld_location',$location_id);
        if($type == 'posted'){
            $query->where('fld_posted','Yes');
        }
        return $query->count();
    }

    protected function getSummaryCountSold($start_date,$location_id,$type,$newUsed = 2){
        $query = Delivery::where('s_spare','No')->where('fld_new_used',2)
            ->where(function($q){ return $q->where('fld_tracker_type',1)->orWhere('fld_tracker_type',2); })->where('fld_location',$location_id);
        if($type == 'funded'){
            $query->where('fld_funded','No');
        }else{
            $query->where('fld_funded','Yes')->where('fld_date','>=',$start_date)
                ->where(function($q){ return $q->where('fld_posted','No')->orWhereNull('fld_posted'); });
        }
        return $query->count();
    }

    public function postedSale(Locations $location, Request $request){
        $date = new \DateTime('-111 month');

        $deliveries = Delivery::has('userdetail')
            ->where('fld_posted','Yes')
            ->whereDate('fld_date','>',$date->format('Y-m-d'))
            ->where('fld_location',$location->id)
            ->where('fld_funded','Yes')
            ->where('s_spare','<>','Yes')
            ->orderByRaw('fld_posted ASC , fld_date ASC');
        //->orderBy('fld_posted','ASC');

        if($request->ajax()){
            $deliveries->with('saleperson','saleperson2');
            
            return DataTables::of($deliveries)
                ->editColumn('fld_date', function($delivery){ return  date('D d M, Y',strtotime($delivery->fld_date)); })
                ->editColumn('fld_time', function($delivery){ return  date('g:i A',strtotime($delivery->fld_time)); })
                ->addColumn('vehicleDataExist', function($delivery){ return  Vehicles::where('fldStockNo',$delivery->fld_stock)->exists(); })
                ->make(true);
        }

        return view('sales-tracking.posted-sale',compact('location','deliveries'));

    }

    public function unpostedSale(Locations $location, Request $request){
        $date = new \DateTime('-8 month');

        $limit = ($request->has('limit')) ? $request->limit : 300;

        $deliveries = Delivery::has('userdetail')
                        ->where(function ($q){
                            $q->where('fld_posted','No')->orWhere('fld_posted','')->orWhereNull('fld_posted');
                        })
                       // ->orWhereNull('fld_posted')
                        ->whereDate('fld_date','>',$date->format('Y-m-d'))
                        ->where('fld_location',$location->id)
                        ->where('fld_funded','Yes')
                        ->where('s_spare','<>','Yes')
                        //->orderBy('fld_posted','ASC')
                        ->orderByRaw('fld_posted ASC , fld_date ASC')
                        ->paginate($limit);

        if($request->has('page') && $request->page > 1 && $deliveries->count() == 0){
            return redirect()->route('unposted-sale',[$location->id]);
        }

        return view('sales-tracking.unposted-sale',compact('location','deliveries'));
    }

    public function salesRanking()
    {
        $ranking = self::getSalesRanking();

        $salesman = Userdetails::whereIn('id',array_keys($ranking))->get();
        $salesman = $salesman->map(function ($user) use ($ranking){
            return $user->setAttribute('rank',$ranking[$user->id]);
        })->sortByDesc('rank');

        return view('sales-tracking.sales-ranking',compact('salesman'));
    }

    public static function getSalesRanking()
    {
        $stricklandTarget   =   Locations::find(100);

        $deliveries = Delivery::where('fld_date','>=',$stricklandTarget->day_start)
            ->where('s_spare','No')
            ->where('fld_funded','Yes')
            ->get();

        $ranking = [];

        foreach($deliveries as $delivery){

            if(!isset($ranking[$delivery->fld_sperson])){
                $ranking[$delivery->fld_sperson] = 0;
            }


            if($delivery->fld_sperson2){
                if(!isset($ranking[$delivery->fld_sperson2])){
                    $ranking[$delivery->fld_sperson2] = 0;
                }
                $ranking[$delivery->fld_sperson2] += 0.5;
                $ranking[$delivery->fld_sperson] += 0.5;
            }else{
                $ranking[$delivery->fld_sperson] += 1;
            }
        }

        return $ranking;
    }

    public function dailySales(Request $request)
    {
        $sales = Delivery::where('fld_sale_date',request('date',date('Y-m-d')))->get();
        return view('sales-tracking.daily-sales',compact('sales'));
    }

}
