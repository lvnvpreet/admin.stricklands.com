<?php

namespace Vanguard\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanguard\Models\Locations;
use Vanguard\Models\GuestTrackerHistory;
use Vanguard\Models\GuestTypes;

/**
 * Class ActivityController
 * @package Vanguard\Http\Controllers
 */
class GuestTrackingController extends Controller
{

    /**
     * GuestTrackingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $location)
    {
        $name = 'Total';
        $location_ids = [];
        if($location == "all"){
            $location_ids = [1,2,5,7,8];
        }else{
            $location_ids[] = $location;
            $name = Locations::where('fldLocation', $location)->first()->value('fldLocationName');
        }
        
        $history = GuestTrackerHistory::whereIn('location_id', $location_ids)->get();
        $names = $location_names = null;
        
        $locations = Locations::whereIn('fldLocation', $location_ids)->get();
        $types = GuestTypes::all();
        $guest_history = [];
        $guest_history_by_locations = [];
        $names = $types->pluck('name')->toArray();
        foreach($types as $type){
            $guest_history[] = [
                'value' => $type->guest_history()->whereIn('location_id', $location_ids)->count(),
                'name' => $type->name
            ];
        }
        if($location == "all"){
            $location_names = $locations->pluck('fldShortName')->toArray();
            foreach($locations as $type){
                $guest_history_by_locations[] = [
                    'value' => $type->guest_history()->count(),
                    'name' => $type->fldShortName
                ];
            }
        }
        
        
        if ($request->ajax()) {
            return view('guest-tracking.index', compact('history', 'types','name', 'names', 'guest_history','location','locations','location_names','guest_history_by_locations'));
        }

        return view('guest-tracking.index', compact('history', 'types', 'name', 'names', 'guest_history','location','locations','location_names','guest_history_by_locations'));
    }
    
    public function save(Request $request){
        try{
            GuestTrackerHistory::create($request->all());
        }catch(\Exception $e){
            return redirect()->route('guest-tracking',['location', $request->input('location_id')])->withErrors($e->getMessage());
        }
        return redirect()->route('guest-tracking',['location' => $request->input('location_id')])->withSuccess('Your entry was successfully created.');
    }
}