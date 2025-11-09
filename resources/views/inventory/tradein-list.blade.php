@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div style="padding-left: 10px;">
                            <h2 class="panel-title">Trade In List View | <span style="color: red;">BOS (Bill of Sale) = $ off Deal | | Admin-Retail = Retail $ for One-Eighty | Admin-ACV = ACV for One-Eighty</span></h2><span style="color:limegreen;">Press "Cntrl -" key if you can't see the update buttons.</span>
                        </div>
                        <div class="col col-xs-6 text-right">

                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered datatable" id="dyntable">
                        <thead>
                        <th>Stock Number</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Colour</th>
                        <th>KMs</th>
                        <th>VIN</th>
                        <th>Options</th>
                        <th>Notes</th>

                        <th>Location</th>
                        <th>Interior</th>
                        <th>Exterior</th>
                        <th>Specialty</th>

                        <th>BOS/ACV</th>
                        <!--                             <th>ACV</th> -->

                        <th>Trim</th>
                        <th>Admin-Retail</th>
                        <th>Admin-ACV</th>
                        <th>Status</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($trades as $trade)

                            <tr>
                                <form action="{{ route('.update.trade-list', $trade->id) }}" method="post"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <td><a data-toggle="tooltip" href="#"
                                           title="{{ $trade->fld_customer . ': ' . $trade->fld_year . ' ' . $trade->fld_make . ' ' . $trade->fld_model }}">{{ $trade->fld_trade_stock }}</a>
                                    </td>
                                    <td>{{ $trade->fld_trade_year }} <input type="hidden" name="fld_trade_year"
                                                                            value="{{ $trade->fld_trade_year }}">
                                    </td>
                                    <td>{{ $trade->fld_trade_make }} <input type="hidden" name="fld_trade_make"
                                                                            value="{{ $trade->fld_trade_make }}">
                                    </td>
                                    <td>{{ $trade->fld_trade_model }} <input type="hidden" name="fld_trade_model"
                                                                             value="{{ $trade->fld_trade_model }}">
                                    </td>
                                    <td>{{ $trade->fld_trade_colour }} <input type="hidden" name="fld_trade_colour"
                                                                              value="{{ $trade->fld_trade_colour }}">
                                    </td>
                                    <td>{{ $trade->fld_trade_mileage }} <input type="hidden"
                                                                               name="fld_trade_mileage"
                                                                               value="{{ $trade->fld_trade_mileage }}">
                                    </td>
                                    <td>{{ $trade->fld_trade_vin }}<input type="hidden" name="fld_trade_acv"
                                                                          value="{{ $trade->fld_trade_acv }}"></td>

                                    @if($trade->fld_trade_options <> '')
                                        <td><a data-toggle="tooltip" href="#"
                                               title="{{ implode(' ',$trade->fld_trade_options). " Engine: " . $trade->fld_trade_cylinder . " Trans: " . $trade->fld_trade_transmission . " Drive: " . $trade->fld_trade_drive . " Type: " . $trade->fld_trade_type }}">Hover</a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if($trade->fld_trade_notes <> '')
                                        <td><a data-toggle="tooltip" href="#"
                                               title="{{ $trade->fld_trade_notes }}">Hover</a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        <input type="hidden" name="location" value="{{ $trade->fld_location }}">
                                        <input type="hidden" name="stock" value="{{ $trade->fld_trade_stock }}">
                                        <span class="mediumfont">

                                                @if ($trade->fld_location == "1")
                                                Stratford
                                            @elseif ($trade->fld_location == "2")
                                                Windsor
                                            @elseif ($trade->fld_location == "5")
                                                Toyota
                                            @elseif ($trade->fld_location == "8")
                                                Brantford GM
                                            @else
                                                No Input
                                            @endif

                                            </span>
                                    </td>
                                    <td>{{ $trade->fld_trade_interior }}</td>
                                    <td>{{ $trade->fld_trade_exterior }}</td>
                                    <td>
                                        <select name="fld_trade_specialty" class="input-small">
                                            <option value="" {{ $trade->fld_trade_specialty == ''?: 'selected' }}>
                                                Specialty
                                            </option>
                                            <option value="Yes" {{ $trade->fld_trade_specialty == 'Yes'?: 'selected' }}>
                                                Yes
                                            </option>
                                            <option value="No" {{ $trade->fld_trade_specialty == 'No'?: 'selected' }}>
                                                No
                                            </option>
                                        </select>
                                    </td>

                                    <td>{{ $trade->fld_trade_acv }}</td>
                                <!--                                         <td>{{ $trade->trade_manager_acv }}</td> -->
                                    <td><input style="width: 100%" type="text" class="input-group-xs"
                                               name="fld_trade_trim" value="{{ $trade->fld_trade_trim }}"></td>
                                    <td><input style="width: 100%" type="text" class="input-group-xs"
                                               name="fld_trade_retail" value="{{ $trade->fld_trade_retail }}"></td>
                                    <td><input style="width: 100%" type="text" class="input-group-xs"
                                               name="fld_trade_cost" value="{{ $trade->fld_trade_cost }}"></td>
                                    <td>
                                        <select name="fld_trade_status" class="input-xsmall">
                                            <option value="">Status</option>
                                            <option value="NoStatus">No Status</option>
                                            <option value="AsIs">As Is</option>
                                            <option value="Gold">Gold</option>
                                            <option value="SS">SS</option>
                                        </select>
                                    </td>
                                    <td><input class="" type="submit" value="Update"/></td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $(".datatable").dataTable({
                "order": []
               }); 
            
            $('[data-toggle="tooltip"]').tooltip();
            let row = $('#dyntable_wrapper').children().eq(1);
            row.css('overflow','auto');
        });
    </script>
@stop
