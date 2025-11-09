<div class="panel-heading">
    <div class="row">
        <div style="padding-left: 10px;">
            <h2 class="panel-title">Trade In List View | <span style="color: red;">BOS (Bill of Sale) = $ off Deal | Admin-Retail = Retail $ for One-Eighty | Admin-ACV = ACV for One-Eighty</span></h2>
        </div>
        <div class="col col-xs-6 text-right">

        </div>
    </div>
</div>
<div class="panel-body table-responsive">
    <table class="table table-striped table-bordered datatable" id="dyntable">
        <thead>
        <th style="display: none;">#</th>
        <th>Date</th>
        <th>Stock Number </th>
        <th>Year</th>
        <th>Make</th>
        <th>Model</th>
        <th>Colour</th>
        <th>KMs</th>
        <th>VIN</th>
        <th>BOS/ACV</th>
        <th>Admin-Retail</th>
        <th>Admin-ACV</th>
        <th>Status</th>
        <th>Location</th>
        <th>Pricing</th>

        </thead>
        <tbody>
        @foreach($vehicles as $vehicle)
            <tr>
                <form action="" method="post">
                    <td style="display: none;">{{ $loop->iteration }}</td>
                    <td><span class="mediumfont">{{ $vehicle->fld_date }}</span></td>
                    <td>
                                <span class="mediumfont">
                                    {{--@if($vehicle->fld_tradein_level!=1)
                                        {{ $vehicle->fld_trade_stock }}
                                    @else
                                        <a href="#">
                                        {{ $vehicle->fld_trade_stock }}
                                        </a>
                                    @endif--}}
                                 <a href="{{ route('inventory.trade-list-view-detail',$vehicle->fld_trade_stock) }}" target="_blank">
                                     {{ $vehicle->fld_trade_stock }}
                                 </a>
                                </span>
                    </td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_year }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_make }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_model }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_colour }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_mileage }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_vin }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_acv }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_retail }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_cost }}</span></td>
                    <td><span class="mediumfont">{{ $vehicle->fld_trade_status }}</span></td>
                    <td><span class="mediumfont">
                            <?
                            $locationfl=$vehicle->fld_location;
                            //echo $locationfl;
                            if ( $locationfl == 1 ) { echo 'Stratford';}
                            if ( $locationfl == 2 ) { echo 'Windsor';}
                            if ( $locationfl == 5 ) { echo 'Toyota';}
                            if ( $locationfl == 8 ) { echo 'Brantford GM';}
                            ?>
                        </span></td>
                    <td><span class="mediumfont"> {{ $vehicle->trade_user ? $vehicle->trade_user->details->fld_usr_fname .' '. $vehicle->trade_user->details->fld_usr_lastname : ''  }}</span></td>

                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- @if(isset($vehicles) && count($vehicles))
     <div class="panel-footer">
         <div class="row">
             <div class="col col-xs-4">Page {{ $vehicles->currentPage() }} of {{ $vehicles->lastPage() }}
             </div>
             <div class="col col-xs-8">
                 {{ $vehicles->appends(Input::except('page'))->links() }}
                 <ul class="pagination visible-xs pull-right">
                     <li><a href="#">«</a></li>
                     <li><a href="#">»</a></li>
                 </ul>
             </div>
         </div>
     </div>
 @endif--}}
