<?php

namespace Vanguard\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Vanguard\Http\Controllers\Controller;

use Vanguard\Models\Vehicledescription;
use Vanguard\User;
use Custom;
use Illuminate\Http\Request;
use Vanguard\Models\Locations;
use Vanguard\Models\Statuscode;
use Vanguard\Models\Vehicletypes;
use Vanguard\Models\Vehicles;
use Vanguard\Models\Delivery;
use Vanguard\Mail\TradeUpdated;
use Auth;
use Mail;

/**
 * Class ActivityController
 * @package Vanguard\Http\Controllers
 */
class InventoryController extends Controller
{
    /**
     * @var EloquentActivity
     */
    private $activities;

    /**
     * InventoryController constructor.
     * @param ActivityRepository $activities
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:inventory.search');
        //$this->activities = $activities;
    }

    /**
     * Displays the page with activities for all system users.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $locations = Locations::where('id', '<>', 100)->orderby('fldLocationOrder', 'asc')->pluck('fldLocationName', 'fldCode')->toArray();
        $locations = array_merge(['all' => 'All Locations'], $locations);
        $types = Vehicletypes::all()->pluck('fldDesc', 'fldCode')->toArray();
        $types = array_merge(['all' => 'All Type'], $types);
        $inventories = Statuscode::all()->pluck('fld_desc', 'fld_code')->toArray();
        $inventories = array_merge(['all' => 'All Inventory'], $inventories);
        $make = Vehicles::distinct()->orderby('fldMake', 'asc')->pluck('fldMake', 'fldMake')->toArray();
        $makes = array_merge(['all' => 'All Makes'], $make);

        //dd($request->all());


        if (count($request->all())) {
            $vehicles = Vehicles::where('fldSoldStatus', 0)->where('fldkey2', '<>','H');

            if ($request->has('location') && $request->get('location') != 'all') {
                $vehicles->where('fldLocation', $request->get('location'));
            }

            if ($request->has('inventory') && $request->get('inventory') != 'all') {
                if ($request->get('inventory') != 'C') {
                    $vehicles->where('fldStatusCode', $request->get('inventory'));
                } else {
                    $vehicles->where('fldCode', 'A');
                }
            }

            if ($request->has('type') && $request->get('type') != 'all') {
                $vehicles->where('fldType', $request->get('type'));
            }
            if ($request->has('price') && $request->get('price') != 'all') {
                $vehicles->where('fldRetail', '<', $request->get('price'));
            }
            if ($request->has('year') && $request->get('year') != 'all') {
                $vehicles->where('fldYear', $request->get('year'));
            }
            if ($request->has('make') && $request->get('make') != 'all') {
                $vehicles->where('fldMake', $request->get('make'));
            }
            if ($request->has('kms') && $request->get('kms') != 'all') {
                $vehicles->where('fldOdometer','<=', $request->get('kms'));
            }
            if ($request->has('model') && $request->get('model') != '') {
                $vehicles->where('fldModel', 'LIKE', '%' . $request->get('model') . '%');
            }
            if ($request->has('stock') && $request->get('stock') != '') {
                $vehicles->where('fldStockNo', $request->get('stock'));
            }
            $allvehicles = Vehicles::all();
            $vehicles = $vehicles->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC')->get();
            $vehicles->load('timers');
            //dd($vehicles);
            if ($request->ajax()) {
                return view('inventory.list-load', compact('vehicles'));
            }
            return view('inventory.list', compact('locations', 'types', 'inventories', 'makes', 'vehicles', 'allvehicles'));
        } else {
            $allvehicles = Vehicles::all();
            $vehicles = new Collection;
            return view('inventory.list', compact('locations', 'types', 'inventories', 'makes', 'allvehicles', 'vehicles'));
        }
    }

    public function search4days(Request $request)
    {

        $locations = Locations::where('id', '<>', 100)->pluck('fldLocationName', 'fldCode')->toArray();
        $locations = array_merge(['all' => 'All Locations'], $locations);
        $types = Vehicletypes::all()->pluck('fldDesc', 'fldCode')->toArray();
        $types = array_merge(['all' => 'All Type'], $types);
        $inventories = Statuscode::all()->pluck('fld_desc', 'fld_code')->toArray();
        $inventories = array_merge(['all' => 'All Inventory'], $inventories);
        $make = Vehicles::distinct()->orderby('fldMake', 'asc')->pluck('fldMake', 'fldMake')->toArray();
        $makes = array_merge(['all' => 'All Makes'], $make);

        $vehicles = Vehicles::where('fldDateReceived', '>', Carbon::now()->subDay(4))->where('fldkey2', '<>','H')->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC');
        $allvehicles = Vehicles::all();
        $vehicles = $vehicles->get();

        //dd($vehicles);
        if ($request->ajax()) {
            return view('inventory.list-load', compact('vehicles', 'allvehicles'));
        }

        return view('inventory.list', compact('locations', 'types', 'inventories', 'makes', 'vehicles', 'allvehicles'));

    }

    public function search14days(Request $request)
    {

        $locations = Locations::where('id', '<>', 100)->pluck('fldLocationName', 'fldCode')->toArray();
        $locations = array_merge(['all' => 'All Locations'], $locations);
        $types = Vehicletypes::all()->pluck('fldDesc', 'fldCode')->toArray();
        $types = array_merge(['all' => 'All Type'], $types);
        $inventories = Statuscode::all()->pluck('fld_desc', 'fld_code')->toArray();
        $inventories = array_merge(['all' => 'All Inventory'], $inventories);
        $make = Vehicles::distinct()->orderby('fldMake', 'asc')->pluck('fldMake', 'fldMake')->toArray();
        $makes = array_merge(['all' => 'All Makes'], $make);


        $vehicles = Vehicles::where('fldDateReceived', '>', Carbon::now()->subDay(14))->where('fldkey2', '<>','H')->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC');
        $allvehicles = Vehicles::all();
        $vehicles = $vehicles->get();
        //dd($vehicles);

        if ($request->ajax()) {
            return view('inventory.list-load', compact('vehicles', 'allvehicles'));
        }

        return view('inventory.list', compact('locations', 'types', 'inventories', 'makes', 'vehicles', 'allvehicles'));
    }

    public function searchUsedVechicle(Request $request)
    {
        $vehiclesIds = [
            "T24079",
            "T24064",
            "T24017",
            "T24072",
            "T24061",
            "T24068",
            "T24052",
            "T24060",
            "T24024",
            "T24040",
            "T23350",
            "T23314",
            "T23239",
            "T23462"
        ];
        $vehicles = Vehicles::whereIn('fldStockNo', $vehiclesIds)->where('fldLocationCode','T')->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC')->get();
        $allvehicles = Vehicles::all();

        if ($request->ajax()) {
            return view('inventory.list-load', compact('vehicles', 'allvehicles'));
        }

        return view('inventory.used-vehicle', compact('vehicles', 'allvehicles'));
    }

    
    public function ListPopUP(Request $request, $stockNo)
    {

        if ($request->ajax()) {
            $vehicle = Vehicles::where('fldStockNo', $stockNo)->firstOrFail();
            return view('inventory.list-popup', compact('vehicle'));
        }
        abort(404);


    }


    public function print(Request $request)
    {
        $locations = Locations::where('id', '<>', 100)->pluck('fldLocationName', 'fldCode')->toArray();
        $locations = array_merge(['all' => 'All Locations'], $locations);
        $types = Vehicletypes::all()->pluck('fldDesc', 'fldCode')->toArray();
        $types = array_merge(['all' => 'All Type'], $types);
        $inventories = Statuscode::all()->pluck('fld_desc', 'fld_code')->toArray();
        $inventories = array_merge(['all' => 'All Inventory'], $inventories);
        $make = Vehicles::distinct()->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC')->pluck('fldMake', 'fldMake')->toArray();
        $makes = array_merge(['all' => 'All Makes'], $make);

        //dd($request->all());


        if (count($request->all())) {
             $vehicles = Vehicles::where('fldSoldStatus', 0)->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModel', 'DESC')->orderby('fldCode', 'ASC');

            if ($request->has('location') && $request->get('location') != 'all') {
                $vehicles->where('fldLocation', $request->get('location'));
            }
            if ($request->has('inventory') && $request->get('inventory') != 'all') {

               if ($request->get('inventory') != 'C') {
                    $vehicles->where('fldStatusCode', $request->get('inventory'));
                } else {
                    $vehicles->where('fldCode', 'A');
                }

            }
            if ($request->has('type') && $request->get('type') != 'all') {
                $vehicles->where('fldType', $request->get('type'));
            }
            if ($request->has('price') && $request->get('price') != 'all') {
                //$vehicles->where('fldRetail','<',$request->get('price'));
            }
            if ($request->has('year') && $request->get('year') != 'all') {
                $vehicles->where('fldYear', $request->get('year'));
            }
            if ($request->has('make') && $request->get('make') != 'all') {
                $vehicles->where('fldMake', $request->get('make'));
            }
            if ($request->has('kms') && $request->get('kms') != 'all') {
                $vehicles->where('fldOdometer', '<=', $request->get('kms'));
            }

            if ($request->has('model') && $request->get('model') != '') {
                $vehicles->where('fldModel', 'LIKE', '%' . $request->get('model') . '%');
            }
            if ($request->has('stock') && $request->get('stock') != '') {
                $vehicles->where('fldStockNo', $request->get('stock'));
            }

            $vehicles = $vehicles->get();
            //dd($vehicles);

            return view('inventory.print-preview', compact('vehicles'));
        } else {
            return view('inventory.print', compact('locations', 'types', 'inventories', 'makes'));
        }
    }


    public function count()
    {

        $vehicles = Vehicles::all();

        $data['vehicles'] = $vehicles = $vehicles->groupBy(function ($value) {
            return $value['fldType'];
        });

        $data['newreadycars'] = $vehicles['C']->where('fldStatusCode', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['newreadysuvs'] = $vehicles['S']->where('fldStatusCode', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['newreadyvans'] = $vehicles['V']->where('fldStatusCode', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['newreadytrucks'] = $vehicles['T']->where('fldStatusCode', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['newreadytotal'] = $data['newreadycars'] + $data['newreadysuvs'] + $data['newreadyvans'] + $data['newreadytrucks'];

        $data['newsoldcars'] = $vehicles['C']->where('fldStatusCode', 'N')->where('fldKey1', 'P')->count();
        $data['newsoldsuvs'] = $vehicles['S']->where('fldStatusCode', 'N')->where('fldKey1', 'P')->count();
        $data['newsoldvans'] = $vehicles['V']->where('fldStatusCode', 'N')->where('fldKey1', 'P')->count();
        $data['newsoldtrucks'] = $vehicles['T']->where('fldStatusCode', 'N')->where('fldKey1', 'P')->count();
        $data['newsoldtotal'] = $data['newsoldcars'] + $data['newsoldsuvs'] + $data['newsoldvans'] + $data['newsoldtrucks'];


        $data['oldreadycars'] = $vehicles['C']->where('fldStatusCode', '<>', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['oldreadysuvs'] = $vehicles['S']->where('fldStatusCode', '<>', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['oldreadyvans'] = $vehicles['V']->where('fldStatusCode', '<>', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['oldreadytrucks'] = $vehicles['T']->where('fldStatusCode', '<>', 'N')->where('fldKey1', '<>', 'P')->count();
        $data['oldreadytotal'] = $data['oldreadycars'] + $data['oldreadysuvs'] + $data['oldreadyvans'] + $data['oldreadytrucks'];

        $data['oldsoldcars'] = $vehicles['C']->where('fldStatusCode', '<>', 'N')->where('fldKey1', 'P')->count();
        $data['oldsoldsuvs'] = $vehicles['S']->where('fldStatusCode', '<>', 'N')->where('fldKey1', 'P')->count();
        $data['oldsoldvans'] = $vehicles['V']->where('fldStatusCode', '<>', 'N')->where('fldKey1', 'P')->count();
        $data['oldsoldtrucks'] = $vehicles['T']->where('fldStatusCode', '<>', 'N')->where('fldKey1', 'P')->count();
        $data['oldsoldtotal'] = $data['oldsoldcars'] + $data['oldsoldsuvs'] + $data['oldsoldvans'] + $data['oldsoldtrucks'];

        return view('inventory.count', $data);
    }


    public function description(Request $request)
    {

        $locations = Locations::where('id', '<>', 100)->pluck('fldLocationName', 'fldCode')->toArray();
        $locations = array_merge(['all' => 'All Locations'], $locations);
        $types = Vehicletypes::all()->pluck('fldDesc', 'fldCode')->toArray();
        $types = array_merge(['all' => 'All Type'], $types);
        $inventories = Statuscode::all()->pluck('fld_desc', 'fld_code')->toArray();
        $inventories = array_merge(['all' => 'All Inventory'], $inventories);
        $make = Vehicles::distinct()->orderby('fldYear', 'DESC')->orderby('fldMake', 'DESC')->orderby('fldModelNo', 'DESC')->pluck('fldMake', 'fldMake')->toArray();
        $makes = array_merge(['all' => 'All Makes'], $make);

        //dd($request->all());


        if (count($request->all())) {
            $vehicles = Vehicles::with(['logistic_notes', 'description'])->where('fldSoldStatus', 0);

            if ($request->has('location') && $request->get('location') != 'all') {
                $vehicles->where('fldLocation', $request->get('location'));
            }
            if ($request->has('inventory') && $request->get('inventory') != 'all') {
                $vehicles->where('fldStatusCode', $request->get('inventory'));
            }
            if ($request->has('type') && $request->get('type') != 'all') {
                $vehicles->where('fldType', $request->get('type'));
            }
            if ($request->has('price') && $request->get('price') != 'all') {
                //$vehicles->where('fldRetail','<',$request->get('price'));
            }
            if ($request->has('year') && $request->get('year') != 'all') {
                $vehicles->where('fldYear', $request->get('year'));
            }
            if ($request->has('make') && $request->get('make') != 'all') {
                $vehicles->where('fldMake', $request->get('make'));
            }
            if ($request->has('kms') && $request->get('kms') != 'all') {
                $vehicles->where('fldOdometer','<=', $request->get('kms'));
            }

            if ($request->has('model') && $request->get('model') != '') {
                $vehicles->where('fldModel', 'LIKE', '%' . $request->get('model') . '%');
            }
            if ($request->has('stock') && $request->get('stock') != '') {
                $vehicles->where('fldStockNo', $request->get('stock'));
            }

            if ($request->has('desc') && $request->get('desc') == 'no') {
                $vehicles->whereDoesntHave('description');

            }
            if ($request->has('desc') && $request->get('desc') == 'yes') {
                $vehicles->whereHas('description', function ($q) {
                    $q->where('fldDescription', '<>', '')->where('fldApproved', 1);
                });
            }

            if ($request->has('pending') && $request->get('pending') == 'yes') {
                $vehicles->whereHas('description', function ($q) {
                    $q->where('fldApproved', 0);
                });
            }
            $allvehicles = Vehicles::all();
            $vehicles = $vehicles->get();
            if ($request->ajax()) {
                return view('inventory.list-load', compact('vehicles'));
            }
            return view('inventory.description', compact('locations', 'types', 'inventories', 'makes', 'vehicles', 'allvehicles'));
        } else {
            $allvehicles = Vehicles::all();
            $vehicles = new Collection;
            return view('inventory.description', compact('locations', 'types', 'inventories', 'makes', 'allvehicles', 'vehicles'));
        }


    }

    public function descriptionPopup(Request $request, $stockNo)
    {

        if ($request->ajax()) {
            $vehicle = Vehicles::where('fldStockNo', $stockNo)->firstOrFail();
            return view('inventory.desp-popup', compact('vehicle'));
        }
        abort(404);
    }

    public function savedescription(Request $request)
    {
        $desp = Vehicledescription::where('fldStockNo', $request->get('stockno'))->first();
        if (!$desp) $desp = new Vehicledescription();
        $desp->fldStockNo = $request->get('stockno');
        $desp->fldTitle = $request->get('title');
        $desp->fldDescription = $request->get('description');
        $desp->fldApproved = $request->get('approved');
        $desp->fldUserId = auth()->user()->id;
        $desp->save();
        return redirect()->back()->with('success', 'Record updated successfully');
    }

    public function TradeListView(Request $request)
    {
        $vehicles = Delivery::with(['trade_user','trade_user.details'])->where('fld_trade_stock', '<>', '')->where('fld_date','>=',now()->subMonths(6))->orderBy('fld_trade_year','DESC')->orderBy('fld_trade_make','DESC')->orderBy('fld_trade_model','DESC')->orderby('fld_date','desc')->get();

        if ($request->ajax()) {
            return view('inventory.tradein-load', compact('vehicles'));
        }
        return view('inventory.tradein', compact('vehicles'));
    }

    public function TradeListViewDetail($stockno, Request $request)
    {

        $delivery = Delivery::where('fld_trade_stock',$stockno)->first();
        if(!$delivery) abort(404);
        //dump($delivery);

        //dd($delivery->fld_trade_options);

        return view('inventory.trade-list-detail', compact('delivery'));

    }

    public function getVehicles()
    {
        $vehicles = \DB::table('old_a_tbl_auction_vehicles')->get();
        $vehicle_data = [];
        foreach ($vehicles as $vehicle) {
            $oldvehicle = \DB::table('old_tblvehicles')->where('fldStockNo', $vehicle->fld_stock_number)->first();
            $user = \DB::table('user_details')->where('id', $vehicle->fld_user_id)->first();
            $vehicle_data[] = array(
                'id' => $vehicle->id,
                'fld_stock_number' => $vehicle->fld_stock_number,
                'fld_auction' => $vehicle->fld_auction,
                'fldYear' => $oldvehicle->fldYear ?? '',
                'fldMake' => $oldvehicle->fldMake ?? '',
                'fldModel' => $oldvehicle->fldModel ?? '',
                'fldShortVINNo' => $oldvehicle->fldShortVINNo ?? '',
                'fld_usr_fname' => $user->fld_usr_fname ?? '',
                'fld_usr_lastname' => $user->fld_usr_lastname ?? ''
            );
        }


        $vehicle_data = collect($vehicle_data)->sortByDesc('fldYear')->sortByDesc('fldMake')->sortByDesc('fldModel');
        
        return view('inventory.vehicle', compact('vehicle_data'));
    }

    public function deleteVehicleAuction($id)
    {

        \DB::table('old_a_tbl_auction_vehicles')->where('id', $id)->delete();
        return redirect('inventory.vehicle');

    }

    public function hiddenVehicle()
    {

        $vehicles = Vehicles::where('fldKey2','H')->orderBy('fldYear','DESC')->get();
        return view('inventory.hidden_vehicle', compact('vehicles'));

    }

    public function tradeList()
    {

        $trades = Delivery::where('fld_display_trade', '<>', 1)->where('fld_trade_stock', '<>', '')->orderBy('fld_trade_year','DESC')->orderBy('fld_trade_make','DESC')->orderBy('fld_trade_model','DESC')->get();
        return view('inventory.tradein-list', compact('trades'));
    }

    public function updateTradeList($id, Request $request)
    {
        // 'fld_trade_specialty' = $request->fld_trade_specialty; this column isn't exist in delivery table
        
        $trade = Delivery::find($id);
        $trade->fld_trade_trim = $request->fld_trade_trim;
        $trade->fld_trade_retail = $request->fld_trade_retail;
        $trade->fld_trade_cost = $request->fld_trade_cost;
        $trade->fld_trade_status = $request->fld_trade_status;
        $trade->fld_display_trade = 1;


        $tradeUpdated = array($trade = Delivery::find($id),
        $trade->fld_trade_trim = $request->fld_trade_trim,
        $trade->fld_trade_retail = $request->fld_trade_retail,
        $trade->fld_trade_cost = $request->fld_trade_cost,
        $trade->fld_trade_status = $request->fld_trade_status,
        $trade->fld_display_trade = 1);

        $trade->fld_trade_userid = Auth::id();
        $trade->save();

        if($request->location == 1){
            $to = 'automarttradein@stricklands.com';
            //$to = 'bmccarthy@stricklands.com'  ;
        }else if($request->location == 5){
            $to = 'toyotatradein@stricklands.com';
        }else if($request->location == 8){
            $to = 'gmtradein@stricklands.com';
        }

        if($to != ''){
            Mail::to($to)->send(new TradeUpdated(Auth::user(),$request->stock, $trade, $request->tradeUpdated));
        }
        
        return redirect()->route('.trade-list');
    }

    public function calculator(){

        return view('inventory.calculator');
    }
}
