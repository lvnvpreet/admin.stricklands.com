
        <div class="modal-content" style="width: 1100px;">
            <div class="modal-header" style="padding-top: 0px;">

                <h4 class="modal-title pull-left">{{ $vehicle->fldYear }} {{ $vehicle->fldMake }} {{ $vehicle->fldModel }} {{ $vehicle->fldModelNo }} - ${{ $vehicle->fldRetail }}</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-4" style="padding: 0px;">

                    @if($vehicle->hasImages())
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @for ($i=2;$i<=60;$i++)
                                    @php
                                        $name = "/home/adminstrick/images.stricklands.com/vin/";
                                        $name .= $vehicle->fldStockNo;
                                        $name .= "-" . $i . ".jpg";
                                    @endphp
                                    @if(file_exists($name))
                                        <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ ($i==1) ? 'active' : '' }}"></li>
                                    @endif
                                @endfor
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @for ($i=2;$i<=60;$i++)
                                    @php
                                        $name = "/home/adminstrick/images.stricklands.com/vin/";
                                        $name .= $vehicle->fldStockNo;
                                        $name .= "-" . $i . ".jpg";
                                    @endphp
                                    @if(file_exists($name))
                                        <div class="carousel-item {{ $i==2 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="https://images.stricklands.com/vin/{{ $vehicle->fldStockNo }}-{{$i}}.jpg" >
                                        </div>
                                    @endif
                                @endfor
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <img style="width: 92%;" src="{{ asset('assets/img/no-image.png') }}"/>
                    @endif

                </div>
                <div class="col-lg-8" style="padding-left: 50px;">
                    <div class="infoframe">
                            <H3>Vehicle Details</H3>
                            <span class="infotext">
                                <strong class="text-info">Stock#: </strong>{{ strtolower($vehicle->fldStockNo) }} |
                                <strong class="text-info">Short Vin#:</strong>{{ strtolower($vehicle->fldShortVINNo) }} |
                                <strong class="text-info">VIN#</strong>: {{  strtolower($vehicle->fldVINNo)}}<br>
                                <strong class="text-info">Color: </strong>{{ strtolower($vehicle->fldExteriorColor)}} |
                                <strong class="text-info">
                                    <span class="infotext">Engine: </span></strong>
                                    <span class="infotext">{{ $vehicle->fldCyl }}Cyl., {{ $vehicle->fldEngine }}<strong class="text-info"><br />
                                </strong>
                            </span>

                                <strong class="text-info"> <span class="infotext">Transmission:</span></strong>
                            <span class="infotext">
                                @if($vehicle->fldTransmission == "A")
                                    Automatic
                                @endif
                                @if($vehicle->fldTransmission == "5SPD" || $vehicle->fldTransmission=='5S')
                                    5 Speed
                                @endif

                                <strong class="text-info"><br /></strong>
                            </span>
                            <strong class="text-info">
                                <span class="infotext">KM's:</span>
                            </strong>
                            <span class="infotext">{{ number_format($vehicle->fldOdometer,0,'.',',') }}</span> |
                            <strong class="text-info">
                                <span class="infotext">Price:</span>
                            </strong>
                            <span class="infotext"> ${{ number_format($vehicle->fldRetail,0,'.',',') }}<br /></span>
                            <span class="infotext"><strong class="text-info">Options:</strong>
                                <?php
                                //function explosion($row_rs_detail['fldAllCodes'])
                                //{
                                //echo $row_rs_detail['fldAllCodes'];
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
                                } // end for
                                echo $vinexplosion;
                                //return $vinexplosion;
                                //}
                                ?>
                            </span><br/>

                                <span class="infotext"><strong class="text-info">Location:</strong>
                                    {{ $vehicle->fldLocationCode }}</strong></strong>
                                </span>

                                @if ($vehicle->fldComments != "")

                                    <strong class="text-info"> | Info:</strong> {{ $vehicle->fldComments }}
                                @endif
                                @if ($vehicle->fld_Exploded != "")
                                       <div class="detailfeatures">
                                            <span class="detailtext"><strong class="text-info">Detailed Features: </strong>
                                                {{ $vehicle->fld_Exploded }}
                                            </span>
                                       </div>
                                @endif
            </div>
        </div>

                <div class="col-lg-12" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px">
                    <form action="{{ route('inventory.description') }}" method="post" id="description_update" >
                    {{ csrf_field() }}
                    <label>Title</label><br/>
                    <input type="text" class="form-control" name="title" value="{{ @$vehicle->description->fldTitle }}">
                    <label>Description</label><br/>
                    <textarea name="description" style="height: 100px;" class="form-control">{{ @$vehicle->description->fldDescription }}</textarea>
                    <br/>
                    <span class="pull-right">
                        <input type="checkbox" style="float: left; width: 20px;" {{ @$vehicle->description->fldApproved==1 ? 'checked' : ''  }}  name="approved" value="1" class="form-control">&nbsp;Approved &nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-primary" value="Insert Description">
                    </span>
                        <input type="hidden" name="stockno" value="{{ @$vehicle->fldStockNo }}">
                    </form>
                </div>

        </div>

    </div>

        @section('scripts')


            <script>
                $(function(){
                    $('#slides').slides({
                        preload: true,
                        preloadImage: '{{ asset('assets/img/loading.gif') }}',
                        pause: 8500,
                        hoverPause: true
                    });
                });


               /*function updatedesc() {
                     e.preventDefault();
                     $.ajax({
                         type: "POST",
                         url: '',
                         data: $("#description_update").serialize(), // serializes the form's elements.
                         success: function(data)
                         {
                             alert(data); // show response from the php script.
                         }
                     });


                 }*/


            </script>
            @stop
