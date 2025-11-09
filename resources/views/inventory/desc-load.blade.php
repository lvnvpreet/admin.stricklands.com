
            <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                        <h2 class="panel-title">Vehicles</h2>
                    </div>
                    <div class="col col-xs-6 text-right">

                    </div>
                </div>
            </div>
            <div class="panel-body">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <th width="25%" class="head0">Vehicle</th>
                        <th width="4%" class="head0">&nbsp;</th>
                        <th width="10%" nowrap="nowrap" class="head0">Stock</th>
                        <th width="4%" class="head1">L</th>
                        <th width="6%" class="head0">Desc</th>
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
                            @foreach ($vehicles->chunk(100) as $chunk)
                            @foreach ($chunk as $vehicle)
                                <tr>
                                    <td>

                                        @php
                                            $modelno = $vehicle->fldYear." ".$vehicle->fldMake." ".$vehicle->fldModel." ".$vehicle->fldModelNo ;
                                        @endphp
                                            <div data-fancybox data-type="ajax" data-src="{{ route('inventory.description.popup',$vehicle->fldStockNo) }}">
                                            <a  data-toggle="tooltip" data-html="true" data-placement="right" title="{{ $modelno }} | STK#:{{ $vehicle->fldStockNo }} <br/><br/><b>Notes:-</b> {{ wordwrap($vehicle->fldComments, 45, "<br />\n") }}">
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
                                        @if(is_object($vehicle->description) && $vehicle->description->fldDescription!='')
                                            <a  data-toggle="tooltip" data-html="true" data-placement="right" title="{{ $vehicle->description->fldDescription }}">
                                                <img src="{{ asset('assets/img/fugue/tick-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                            </a>
                                        @else
                                            <a  data-toggle="tooltip" data-html="true" data-placement="right" title="No description">
                                            <img src="{{ asset('assets/img/fugue/cross-circle-faded.png')}}" width="14" height="12"  class="lens" />
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $vehicle->fldShortVINNo }}</td>
                                    <td>{{ $vehicle->fldCyl }} cyl</td>
                                    <td>{{ $vehicle->fldTransmission }}</td>
                                    <td>{{ ucwords(strtolower(substr($vehicle->fldExteriorColor,0,13))) }}</td>
                                    <td>*</td>
                                    <td>{{ $vehicle->fldOdometer }}</td>
                                    <td>{{ $vehicle->fldRetail }}</td>


                                </tr>

                            @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12"><em>@lang('app.no_records_found')</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

            </div>
            {{--@if(isset($vehicles) && count($vehicles))
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
