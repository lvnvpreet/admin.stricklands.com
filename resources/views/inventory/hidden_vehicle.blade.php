@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h2 class="panel-title">Hidden Vehicles</h2>
                        </div>
                        <div class="col col-xs-6 text-right">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <th width="25%" class="head0">Vehicle</th>
                        <th width="8%" class="head0">Year</th>
                        <th width="4%" class="head0">&nbsp;</th>
                        <th width="10%" nowrap="nowrap" class="head0">Stock</th>
                        <th width="4%" class="head1">L</th>
                        <th width="6%" class="head0">Days</th>
                        <th width="6%" class="head0">Vin</th>
                        <th width="8%" class="head1">Engine </th>
                        <th width="8%" class="head1">Trans</th>
                        <th width="9%" class="head1">Colour</th>
                        <th width="8%" class="head1">Features</th>
                        <th width="7%" class="head1">KM's</th>
                        <th width="10%" class="head1">Price</th>
                        </thead>

                        <tbody>
                        @if(isset($vehicles) && count($vehicles))
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>

                                        @php
                                            $modelno = $vehicle->fldYear." ".$vehicle->fldMake." ".$vehicle->fldModel." ".$vehicle->fldModelNo ;
                                        @endphp
                                        <div>
                                            <a target="_blank" href="{{ route('vehicle-details',$vehicle->fldStockNo) }}" data-toggle="tooltip" data-html="true" data-placement="right" title="{{ $modelno }} | STK#:{{ $vehicle->fldStockNo }} <br/><br/><b>Notes:-</b> {{ wordwrap($vehicle->fldComments, 45, "<br />\n") }}">
                                                {{ substr($modelno, 0, 40) }}
                                                @if($vehicle->fldCode!='')
                                                    <strong> <span >- {{ $vehicle->fldCode }}</span></strong>
                                                @endif
                                                @if($vehicle->fldKey1 != "")
                                                    <span style="color:red"> - P </span>
                                                @endif
                                                @if($vehicle->fldKey2 == 'X')
                                                    <span style="color:red"> - NP</span>
                                                @endif
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $vehicle->fldYear }}</td>
                                    <td>
                                        @if($vehicle->hasImages())
                                            <a href="{{ route('vehicle-details',$vehicle->fldStockNo) }}">
                                                <img src="{{ asset('assets/img/lens.png') }}" alt="" data-toggle="tooltip" data-html="true" data-placement="right" class="lens" title="{{ $vehicle->fldComments }}">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $vehicle->fldStockNo }}
                                    </td>
                                    <td>{{ $vehicle->fldLocationCode }}</td>
                                    <td>
                                        <?php
                                        $currentdate = date('Y') . "-" . date('m') . "-" . date('d');
                                        $currenttime = date('H:i:s');

                                        $v_datereceived = $vehicle->fldDateReceived;

                                        echo $daysinstock = round((strtotime($currentdate) - strtotime($v_datereceived)) / (60 * 60 * 24), 0, PHP_ROUND_HALF_DOWN);
                                        ?>
                                    </td>
                                    <td>{{ $vehicle->fldShortVINNo }}</td>
                                    <td>{{ $vehicle->fldCyl }} cyl</td>
                                    <td>{{ $vehicle->fldTransmission }}</td>
                                    <td>{{ ucwords(strtolower(substr($vehicle->fldExteriorColor,0,13))) }}</td>
                                    <td>
                                        <?php
                                        $option = "";
                                        $vinexplosion = "";

                                        //for ($c=0; $c < strlen(str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row_rs_detail['fldAllCodes'])); $c++) {
                                        for ($c=0; $c < strlen($vehicle->fldAllCodes); $c++) {
                                            if (substr($vehicle->fldAllCodes,$c,1) == "|")	{
                                                if ((strlen($vinexplosion))>1) {
                                                    $vinexplosion .= ", ";
                                                }
                                                if (strtoupper($option) == "DRBB") {$vinexplosion .= "Previous Rental";}
                                                if (strtoupper($option) == "BLUE") {$vinexplosion .= "Bluetooth";}
                                                if (strtoupper($option) == "HUD") {$vinexplosion .= "Heads Up Display";}
                                                if (strtoupper($option) == "XM") {$vinexplosion .= "XM Radio";}
                                                if (strtoupper($option) == "RCAM") {$vinexplosion .= "Rear Backup Camera";}
                                                if (strtoupper($option) == "SIRRA") {$vinexplosion .= "Sirius Sattelite Radio";}
                                                if (strtoupper($option) == "2.0L") {$vinexplosion .= "2.0LITER";}
                                                if (strtoupper($option) == "2.7L") {$vinexplosion .= "2.7LITER";}
                                                if (strtoupper($option) == "20WH") {$vinexplosion .= "20 INCH WHEELS";}
                                                if (strtoupper($option) == "2TOPS") {$vinexplosion .= "2 TOPS";}
                                                if (strtoupper($option) == "2WD") {$vinexplosion .= "2.0LITER";}
                                                if (strtoupper($option) == "2YTRA") {$vinexplosion .= "2 YEAR OLD TRANSMISSION";}
                                                if (strtoupper($option) == "3.1L") {$vinexplosion .= "3.1LITER";}
                                                if (strtoupper($option) == "3.3L") {$vinexplosion .= "3.3LITER";}
                                                if (strtoupper($option) == "3.5L") {$vinexplosion .= "3.5LITER";}
                                                if (strtoupper($option) == "3.6L") {$vinexplosion .= "3.6LITER";}
                                                if (strtoupper($option) == "3.8L") {$vinexplosion .= "3.8LITER";}
                                                if (strtoupper($option) == "3/4TO") {$vinexplosion .= "3/4 TONNE PACKAGE";}
                                                if (strtoupper($option) == "3S") {$vinexplosion .= "Third Rear Seat";}
                                                if (strtoupper($option) == "4.5L") {$vinexplosion .= "4.6LITER";}
                                                if (strtoupper($option) == "4WD") {$vinexplosion .= "4 WHEEL DRIVE";}
                                                if (strtoupper($option) == "4X4") {$vinexplosion .= "4X4";}
                                                if (strtoupper($option) == "5.4L") {$vinexplosion .= "5.4LITER";}
                                                if (strtoupper($option) == "5.7L") {$vinexplosion .= "5.7LITER HEMI";}
                                                if (strtoupper($option) == "5PASS") {$vinexplosion .= "5 PASSENGER";}
                                                if (strtoupper($option) == "6P") {$vinexplosion .= "6 Passenger";}
                                                if (strtoupper($option) == "7P") {$vinexplosion .= "7 Passenger";}
                                                if (strtoupper($option) == "8P") {$vinexplosion .= "8 Passenger";}
                                                if (strtoupper($option) == "A") {$vinexplosion .= "Air";}
                                                if (strtoupper($option) == "ACCRP") {$vinexplosion .= "ACCIDENT REPAIR";}
                                                if (strtoupper($option) == "ADTR") {$vinexplosion .= "ADVANCE TRAC";}
                                                if (strtoupper($option) == "ADVTR") {$vinexplosion .= "ADVANCED TRAC";}
                                                if (strtoupper($option) == "ALL") {$vinexplosion .= "Alloy Wheels";}
                                                if (strtoupper($option) == "AWD") {$vinexplosion .= "All Wheel Drive";}
                                                if (strtoupper($option) == "BB") {$vinexplosion .= "BUSH BAR";}
                                                if (strtoupper($option) == "BOES") {$vinexplosion .= "BOES STEREO";}
                                                if (strtoupper($option) == "BOX") {$vinexplosion .= "Boxliner";}
                                                if (strtoupper($option) == "BS") {$vinexplosion .= "BUMPER SENSOR";}
                                                if (strtoupper($option) == "BUMP") {$vinexplosion .= "BUMP SENSORS";}
                                                if (strtoupper($option) == "BUSH") {$vinexplosion .= "BUSH BAR";}
                                                if (strtoupper($option) == "C") {$vinexplosion .= "Cruise";}
                                                if (strtoupper($option) == "CA") {$vinexplosion .= "STEREO CASSETTE";}
                                                if (strtoupper($option) == "CD") {$vinexplosion .= "Stereo CD";}
                                                if (strtoupper($option) == "CH") {$vinexplosion .= "Chrome Wheels";}
                                                if (strtoupper($option) == "CHAIR") {$vinexplosion .= "CHAIRLIFT";}
                                                if (strtoupper($option) == "CHILD") {$vinexplosion .= "CHILD SEAT";}
                                                if (strtoupper($option) == "CL") {$vinexplosion .= "CLIMATE";}
                                                if (strtoupper($option) == "COM") {$vinexplosion .= "COMPASS";}
                                                if (strtoupper($option) == "CPACK") {$vinexplosion .= "C PACKAGE";}
                                                if (strtoupper($option) == "D") {$vinexplosion .= "DURATEC";}
                                                if (strtoupper($option) == "DC") {$vinexplosion .= "DUAL CLIMATE CONTROL";}
                                                if (strtoupper($option) == "DD") {$vinexplosion .= "DUTCH DOORS";}
                                                if (strtoupper($option) == "DGR") {$vinexplosion .= "DUAL GLASS ROOF";}
                                                if (strtoupper($option) == "DIES") {$vinexplosion .= "DIESEL";}
                                                if (strtoupper($option) == "DIES") {$vinexplosion .= "DIESEL";}
                                                if (strtoupper($option) == "DPR") {$vinexplosion .= "DUAL PWR ROOFS";}
                                                if (strtoupper($option) == "DVD") {$vinexplosion .= "DVD Player";}
                                                if (strtoupper($option) == "ETEST") {$vinexplosion .= "VALID E TEST";}
                                                if (strtoupper($option) == "EVERY") {$vinexplosion .= "EVERYTHING AVAILABLE";}
                                                if (strtoupper($option) == "EXTW") {$vinexplosion .= "EXTENDED WARRANTY";}
                                                if (strtoupper($option) == "FF") {$vinexplosion .= "FLEX FUEL";}
                                                if (strtoupper($option) == "GTPKG") {$vinexplosion .= "GT PACKAGE";}
                                                if (strtoupper($option) == "HEMI") {$vinexplosion .= "HEMI";}
                                                if (strtoupper($option) == "HIT") {$vinexplosion .= "HITCH";}
                                                if (strtoupper($option) == "HS") {$vinexplosion .= "Heated Seat";}
                                                if (strtoupper($option) == "HTOP") {$vinexplosion .= "Hard Top";}
                                                if (strtoupper($option) == "HUD") {$vinexplosion .= "";}
                                                if (strtoupper($option) == "L") {$vinexplosion .= "Leather Interior";}
                                                if (strtoupper($option) == "L/C") {$vinexplosion .= "LEATHER/CLOTH";}
                                                if (strtoupper($option) == "LIVE") {$vinexplosion .= "FULL LIVING ACCOMODATIONS";}
                                                if (strtoupper($option) == "LOAD") {$vinexplosion .= "LOADING RAMP";}
                                                if (strtoupper($option) == "LUX") {$vinexplosion .= "LUXURY PACKAGE";}
                                                if (strtoupper($option) == "MP3") {$vinexplosion .= "MP3 PLAYER";}
                                                if (strtoupper($option) == "MR") {$vinexplosion .= "MOOR ROOF";}
                                                if (strtoupper($option) == "MTOP") {$vinexplosion .= "MATCHING TOPPER";}
                                                if (strtoupper($option) == "NAV") {$vinexplosion .= "Navigation System";}
                                                if (strtoupper($option) == "NEV") {$vinexplosion .= "NEVADA PACKAGE";}
                                                if (strtoupper($option) == "OFFR") {$vinexplosion .= "OFF ROAD PACKAGE";}
                                                if (strtoupper($option) == "ON") {$vinexplosion .= "Onstar";}
                                                if (strtoupper($option) == "PANA") {$vinexplosion .= "PANA ROOF";}
                                                if (strtoupper($option) == "PANR") {$vinexplosion .= "Panoramic Roof";}
                                                if (strtoupper($option) == "PDR") {$vinexplosion .= "Power Doors";}
                                                if (strtoupper($option) == "PL") {$vinexplosion .= "Power Locks";}
                                                if (strtoupper($option) == "PLPKG") {$vinexplosion .= "PLUS PACKAGE";}
                                                if (strtoupper($option) == "PM") {$vinexplosion .= "Power Mirrors";}
                                                if (strtoupper($option) == "PP") {$vinexplosion .= "PWR PEDDLES";}
                                                if (strtoupper($option) == "PR") {$vinexplosion .= "Power Moonroof";}
                                                if (strtoupper($option) == "PS") {$vinexplosion .= "Power Seats";}
                                                if (strtoupper($option) == "PSR") {$vinexplosion .= "PWR SKYVIEW ROOF";}
                                                if (strtoupper($option) == "PW") {$vinexplosion .= "Power Windows";}
                                                if (strtoupper($option) == "PWDR") {$vinexplosion .= "Power Doors";}
                                                if (strtoupper($option) == "Q") {$vinexplosion .= "Quad Seats";}
                                                if (strtoupper($option) == "RA") {$vinexplosion .= "Radio";}
                                                if (strtoupper($option) == "RAMA") {$vinexplosion .= "RAM AIR";}
                                                if (strtoupper($option) == "RH") {$vinexplosion .= "Rear Heat";}
                                                if (strtoupper($option) == "RIM") {$vinexplosion .= "20 INCH RIMS";}
                                                if (strtoupper($option) == "RPG") {$vinexplosion .= "REAR POWER GROUP";}
                                                if (strtoupper($option) == "RPW") {$vinexplosion .= "REAR POWER WINDOWS";}
                                                if (strtoupper($option) == "RR") {$vinexplosion .= "Rear A/C";}
                                                if (strtoupper($option) == "RRR") {$vinexplosion .= "REAR POWER ROOF";}
                                                if (strtoupper($option) == "RS") {$vinexplosion .= "Rear Spoiler";}
                                                if (strtoupper($option) == "RUN") {$vinexplosion .= "Running Boards";}
                                                if (strtoupper($option) == "RUST") {$vinexplosion .= "RUST PROTECTION";}
                                                if (strtoupper($option) == "SATRA") {$vinexplosion .= "Satellite Radio";}
                                                if (strtoupper($option) == "SHBOX") {$vinexplosion .= "SHORTBOX";}
                                                if (strtoupper($option) == "SHEL") {$vinexplosion .= "SHELVES";}
                                                if (strtoupper($option) == "SIDE") {$vinexplosion .= "SIDEBARS";}
                                                if (strtoupper($option) == "SKY") {$vinexplosion .= "Skylight Roof";}
                                                if (strtoupper($option) == "SLRW") {$vinexplosion .= "SLIDING REAR WINDOW";}
                                                if (strtoupper($option) == "SP") {$vinexplosion .= "STEREO PACKAGE";}
                                                if (strtoupper($option) == "SPEC") {$vinexplosion .= "SPECIAL EDITION";}
                                                if (strtoupper($option) == "SPP") {$vinexplosion .= "Sport Package";}
                                                if (strtoupper($option) == "ST") {$vinexplosion .= "SOFT TOP";}
                                                if (strtoupper($option) == "STAR") {$vinexplosion .= "Remote Starter";}
                                                if (strtoupper($option) == "START") {$vinexplosion .= "Remote Starter";}
                                                if (strtoupper($option) == "STEP") {$vinexplosion .= "STEPSIDE";}
                                                if (strtoupper($option) == "STOP") {$vinexplosion .= "SOFT TOP";}
                                                if (strtoupper($option) == "SUN") {$vinexplosion .= "Sunroof";}
                                                if (strtoupper($option) == "T") {$vinexplosion .= "Tilt Steering";}
                                                if (strtoupper($option) == "TBAR") {$vinexplosion .= "TBAR ROOF";}
                                                if (strtoupper($option) == "TON") {$vinexplosion .= "Tonneau Cover";}
                                                if (strtoupper($option) == "TOP") {$vinexplosion .= "TOPPER";}
                                                if (strtoupper($option) == "TOW") {$vinexplosion .= "Towing Package";}
                                                if (strtoupper($option) == "TRD") {$vinexplosion .= "TRD Package";}
                                                if (strtoupper($option) == "TV") {$vinexplosion .= "TV";}
                                                if (strtoupper($option) == "UNDER") {$vinexplosion .= "UNDERCOATED";}
                                                if (strtoupper($option) == "V6") {$vinexplosion .= "V6";}
                                                if (strtoupper($option) == "V8MAG") {$vinexplosion .= "V8 MAGNUM";}
                                                if (strtoupper($option) == "VCR") {$vinexplosion .= "VCR PLAYER";}
                                                if (strtoupper($option) == "WOOD") {$vinexplosion .= "WOODGRAIN ENHANCED";}
                                                if (strtoupper($option) == "ZR2") {$vinexplosion .= "HIGHBOY ZR2 PACKAGE";}																																            $option = "";
                                            }
                                            else {
                                                $option .= substr($vehicle->fldAllCodes,$c,1);
                                                //						echo "this is the options " . $option;
                                            }
                                        } ?>
                                        <a  data-toggle="tooltip" data-html="true" data-placement="right" title="{{ $vinexplosion }}">
                                            {{ substr($vehicle->fldAllCodes,0,18) }}*
                                        </a>
                                    </td>
                                    <td>{{ $vehicle->fldOdometer }}</td>
                                    <td>{{ $vehicle->fldRetail }}</td>


                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="12"><em>@lang('app.no_records_found')</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>


@endsection

@push('page-js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
