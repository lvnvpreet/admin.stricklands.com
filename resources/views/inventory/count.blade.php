@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">USED VEHICLES</h2>
            </div>
            <div class="card-body">
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">For Sale - Ready  <small>{{ $oldreadytotal }} Total</small></h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="used-vehicles-sale-ready" data-text="testing" class="height-400 echart-container"></div>
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>Cars</th>
                                        <th>SUVs</th>
                                        <th>Minivans</th>
                                        <th>Trucks</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $oldreadycars }}</td>
                                        <td>{{ $oldreadysuvs }}</td>
                                        <td>{{ $oldreadyvans }}</td>
                                        <td>{{ $oldreadytrucks }}</td>
                                        <td>{{ $oldreadytotal }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sold - <small>{{ $oldsoldtotal }} Total</small></h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="used-vehicles-sold" data-text="testing" class="height-400 echart-container"></div>
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>Cars</th>
                                        <th>SUVs</th>
                                        <th>Minivans</th>
                                        <th>Trucks</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $oldsoldcars }}</td>
                                        <td>{{ $oldsoldsuvs }}</td>
                                        <td>{{ $oldsoldvans }}</td>
                                        <td>{{ $oldsoldtrucks }}</td>
                                        <td>{{ $oldsoldtotal }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">New Vehicles</h2>
            </div>
            <div class="card-body" id="pie-doughnut-charts">
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">For Sale - Ready  <small>{{ $newreadytotal }} Total</small></h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="new-vehicles-sale-ready" data-text="testing" class="height-400 echart-container"></div>
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>Cars</th>
                                        <th>SUVs</th>
                                        <th>Minivans</th>
                                        <th>Trucks</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $newreadycars }}</td>
                                        <td>{{ $newreadysuvs }}</td>
                                        <td>{{ $newreadyvans }}</td>
                                        <td>{{ $newreadytrucks }}</td>
                                        <td>{{ $newreadytotal }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sold  <small>{{ $newsoldtotal }} Total</small></h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="new-vehicles-sold" data-text="testing" class="height-400 echart-container"></div>
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>Cars</th>
                                        <th>SUVs</th>
                                        <th>Minivans</th>
                                        <th>Trucks</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $newsoldcars }}</td>
                                        <td>{{ $newsoldsuvs }}</td>
                                        <td>{{ $newsoldvans }}</td>
                                        <td>{{ $newsoldtrucks }}</td>
                                        <td>{{ $newsoldtotal }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Used Inventory Price Audit Results</h2>
            </div>
            <div class="card-body">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabs-1">Stratford Automart</a></li>
                        <li><a href="#tabs-2">Toyota</a></li>
                        <li><a href="#tabs-3">GM</a></li>
                        <li><a href="#tabs-4">Windsor Automart</a></li>
                        <li><a href="#tabs-5">All</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tabs-1" class="tab-pane fade in active">

                            <table class="table table-bordered">
                                <colgroup>
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>$0-$10,000</th>
                                    <th>$10-$15,000</th>
                                    <th>$15-$20,000</th>
                                    <th>$20-$25,000</th>
                                    <th>$25,000+</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cars</td>
                                    <td>{{ $cars1 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $cars2 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $cars3 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $cars4 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $cars5 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>SUV</td>
                                    <td>{{ $suv1 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $suv2 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $suv3 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $suv4 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $suv5 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Van</td>
                                    <td>{{ $van1 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $van2 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $van3 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $van4 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $van5 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Truck</td>
                                    <td>{{ $truck1 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $truck2 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $truck3 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $truck4 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $truck5 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','E')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $cars1 + $suv1 + $van1 + $truck1; ?></td>
                                    <td><?php echo $cars2 + $suv2 + $van2 + $truck2; ?></td>
                                    <td><?php echo $cars3 + $suv3 + $van3 + $truck3; ?></td>
                                    <td><?php echo $cars4 + $suv4 + $van4 + $truck4; ?></td>
                                    <td><?php echo $cars5 + $suv5 + $van5 + $truck5; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="tabs-2" class="tab-pane fade">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>$0-$10,000</th>
                                    <th>$10-$15,000</th>
                                    <th>$15-$20,000</th>
                                    <th>$20-$25,000</th>
                                    <th>$25,000+</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cars</td>
                                    <td>{{ $cars1 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $cars2 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $cars3 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $cars4 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $cars5 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>SUV</td>
                                    <td>{{ $suv1 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $suv2 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $suv3 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $suv4 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $suv5 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Van</td>
                                    <td>{{ $van1 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $van2 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $van3 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $van4 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $van5 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Truck</td>
                                    <td>{{ $truck1 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $truck2 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $truck3 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $truck4 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $truck5 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','T')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $cars1 + $suv1 + $van1 + $truck1; ?></td>
                                    <td><?php echo $cars2 + $suv2 + $van2 + $truck2; ?></td>
                                    <td><?php echo $cars3 + $suv3 + $van3 + $truck3; ?></td>
                                    <td><?php echo $cars4 + $suv4 + $van4 + $truck4; ?></td>
                                    <td><?php echo $cars5 + $suv5 + $van5 + $truck5; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="tabs-3" class="tab-pane fade">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>$0-$10,000</th>
                                    <th>$10-$15,000</th>
                                    <th>$15-$20,000</th>
                                    <th>$20-$25,000</th>
                                    <th>$25,000+</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cars</td>
                                    <td>{{ $cars1 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $cars2 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $cars3 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $cars4 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $cars5 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>SUV</td>
                                    <td>{{ $suv1 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $suv2 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $suv3 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $suv4 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $suv5 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Van</td>
                                    <td>{{ $van1 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $van2 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $van3 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $van4 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $van5 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Truck</td>
                                    <td>{{ $truck1 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $truck2 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $truck3 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $truck4 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $truck5 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','BG')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $cars1 + $suv1 + $van1 + $truck1; ?></td>
                                    <td><?php echo $cars2 + $suv2 + $van2 + $truck2; ?></td>
                                    <td><?php echo $cars3 + $suv3 + $van3 + $truck3; ?></td>
                                    <td><?php echo $cars4 + $suv4 + $van4 + $truck4; ?></td>
                                    <td><?php echo $cars5 + $suv5 + $van5 + $truck5; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="tabs-4" class="tab-pane fade">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>$0-$10,000</th>
                                    <th>$10-$15,000</th>
                                    <th>$15-$20,000</th>
                                    <th>$20-$25,000</th>
                                    <th>$25,000+</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cars</td>
                                    <td>{{ $cars1 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $cars2 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $cars3 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $cars4 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $cars5 = $vehicles['C']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>SUV</td>
                                    <td>{{ $suv1 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $suv2 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $suv3 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $suv4 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $suv5 = $vehicles['S']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Van</td>
                                    <td>{{ $van1 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $van2 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $van3 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $van4 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $van5 = $vehicles['V']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Truck</td>
                                    <td>{{ $truck1 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $truck2 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $truck3 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $truck4 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $truck5 = $vehicles['T']->where('fldStatusCode','U')->where('fldLocation','W')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $cars1 + $suv1 + $van1 + $truck1; ?></td>
                                    <td><?php echo $cars2 + $suv2 + $van2 + $truck2; ?></td>
                                    <td><?php echo $cars3 + $suv3 + $van3 + $truck3; ?></td>
                                    <td><?php echo $cars4 + $suv4 + $van4 + $truck4; ?></td>
                                    <td><?php echo $cars5 + $suv5 + $van5 + $truck5; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="tabs-5" class="tab-pane fade">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>$0-$10,000</th>
                                    <th>$10-$15,000</th>
                                    <th>$15-$20,000</th>
                                    <th>$20-$25,000</th>
                                    <th>$25,000+</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cars</td>
                                    <td>{{ $cars1 = $vehicles['C']->where('fldStatusCode','U')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $cars2 = $vehicles['C']->where('fldStatusCode','U')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $cars3 = $vehicles['C']->where('fldStatusCode','U')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $cars4 = $vehicles['C']->where('fldStatusCode','U')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $cars5 = $vehicles['C']->where('fldStatusCode','U')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>SUV</td>
                                    <td>{{ $suv1 = $vehicles['S']->where('fldStatusCode','U')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $suv2 = $vehicles['S']->where('fldStatusCode','U')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $suv3 = $vehicles['S']->where('fldStatusCode','U')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $suv4 = $vehicles['S']->where('fldStatusCode','U')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $suv5 = $vehicles['S']->where('fldStatusCode','U')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Van</td>
                                    <td>{{ $van1 = $vehicles['V']->where('fldStatusCode','U')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $van2 = $vehicles['V']->where('fldStatusCode','U')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $van3 = $vehicles['V']->where('fldStatusCode','U')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $van4 = $vehicles['V']->where('fldStatusCode','U')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $van5 = $vehicles['V']->where('fldStatusCode','U')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Truck</td>
                                    <td>{{ $truck1 = $vehicles['T']->where('fldStatusCode','U')->where('fldRetail','>=','0')->where('fldRetail','<','10000')->count() }}</td>
                                    <td>{{ $truck2 = $vehicles['T']->where('fldStatusCode','U')->where('fldRetail','>=','10000')->where('fldRetail','<','15000')->count() }}</td>
                                    <td>{{ $truck3 = $vehicles['T']->where('fldStatusCode','U')->where('fldRetail','>=','15000')->where('fldRetail','<','20000')->count() }}</td>
                                    <td>{{ $truck4 = $vehicles['T']->where('fldStatusCode','U')->where('fldRetail','>=','20000')->where('fldRetail','<','25000')->count() }}</td>
                                    <td>{{ $truck5 = $vehicles['T']->where('fldStatusCode','U')->where('fldRetail','>','25000')->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $cars1 + $suv1 + $van1 + $truck1; ?></td>
                                    <td><?php echo $cars2 + $suv2 + $van2 + $truck2; ?></td>
                                    <td><?php echo $cars3 + $suv3 + $van3 + $truck3; ?></td>
                                    <td><?php echo $cars4 + $suv4 + $van4 + $truck4; ?></td>
                                    <td><?php echo $cars5 + $suv5 + $van5 + $truck5; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    {!! HTML::script('assets/vendors/js/charts/echarts/echarts.js') !!}

    {{--{!! HTML::script('assets/js/scripts/charts/echarts/pie-doughnut/basic-pie.js') !!}--}}

    <script>
        $(window).on("load", function(){

            // Set paths
            // ------------------------------

            require.config({
                paths: {
                    echarts: base_url+'/assets/vendors/js/charts/echarts'
                }
            });


            // Configuration
            // ------------------------------

            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],


                // Charts setup
                function (ec) {
                    // Initialize chart
                    // ------------------------------
                    var NewVehiclesReadyForSaleChart = ec.init(document.getElementById('new-vehicles-sale-ready'));
                    //alert(myChart.attr('data-text'));
                    // Chart Options
                    // ------------------------------
                    chartOptions = {
                        // Add title
                        title: {
                            text: 'FOR SALE - READY',
                            //subtext: 'Open source information',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['Cars', 'SUVs', 'Minivans', 'Trucks']
                        },

                        // Add custom colors
                        color: ['#00A5A8', '#626E82', '#FF7D4D','#FF4558'],

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'FOR SALE - READY',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: {{ $newreadycars }}, name: 'Cars'},
                                {value: {{ $newreadysuvs }}, name: 'SUVs'},
                                {value: {{ $newreadyvans }}, name: 'Minivans'},
                                {value: {{ $newreadytrucks }}, name: 'Trucks'}
                            ]
                        }]
                    };

                    // Apply options
                    // ------------------------------

                    NewVehiclesReadyForSaleChart.setOption(chartOptions);



                    var NewVehiclesSold = ec.init(document.getElementById('new-vehicles-sold'));

                    NewVehiclesSoldOptions = {
                        // Add title
                        title: {
                            text: 'SOLD',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['Cars', 'SUVs', 'Minivans', 'Trucks']
                        },

                        // Add custom colors
                        color: ['#00A5A8', '#626E82', '#FF7D4D','#FF4558'],

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'New Vehicles Sold',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: {{ $newreadycars = $vehicles['C']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}, name: 'Cars'},
                                {value: {{ $newreadysuvs = $vehicles['S']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}, name: 'SUVs'},
                                {value: {{ $newreadyvans = $vehicles['V']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}, name: 'Minivans'},
                                {value: {{ $newreadytrucks = $vehicles['T']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}, name: 'Trucks'}
                            ]
                        }]
                    };

                    // Apply options
                    // ------------------------------

                    NewVehiclesSold.setOption(NewVehiclesSoldOptions);



                    var OldVehiclesSaleReady = ec.init(document.getElementById('used-vehicles-sale-ready'));

                    OldVehiclesSaleReadyOptions = {
                        // Add title
                        title: {
                            text: 'FOR SALE - READY',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['Cars', 'SUVs', 'Minivans', 'Trucks']
                        },

                        // Add custom colors
                        color: ['#00A5A8', '#626E82', '#FF7D4D','#FF4558'],

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'FOR SALE - READY',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: {{ $newreadycars = $vehicles['C']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}, name: 'Cars'},
                                {value: {{ $newreadysuvs = $vehicles['S']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}, name: 'SUVs'},
                                {value: {{ $newreadyvans = $vehicles['V']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}, name: 'Minivans'},
                                {value: {{ $newreadytrucks = $vehicles['T']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}, name: 'Trucks'}
                            ]
                        }]
                    };

                    // Apply options
                    // ------------------------------

                    OldVehiclesSaleReady.setOption(OldVehiclesSaleReadyOptions);


                    var OldVehiclesSold = ec.init(document.getElementById('used-vehicles-sold'));

                    OldVehiclesSoldOptions = {
                        // Add title
                        title: {
                            text: 'Sold',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['Cars', 'SUVs', 'Minivans', 'Trucks']
                        },

                        // Add custom colors
                        color: ['#00A5A8', '#626E82', '#FF7D4D','#FF4558'],

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'SOLD',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: {{ $newreadycars = $vehicles['C']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}, name: 'Cars'},
                                {value: {{ $newreadysuvs = $vehicles['S']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}, name: 'SUVs'},
                                {value: {{ $newreadyvans = $vehicles['V']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}, name: 'Minivans'},
                                {value: {{ $newreadytrucks = $vehicles['T']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}, name: 'Trucks'}
                            ]
                        }]
                    };

                    // Apply options
                    // ------------------------------

                    OldVehiclesSold.setOption(OldVehiclesSoldOptions);


                    // Resize chart
                    // ------------------------------

                    $(function () {

                        // Resize chart on menu width change and window resize
                        $(window).on('resize', resize);
                        $(".menu-toggle").on('click', resize);

                        // Resize function
                        function resize() {
                            setTimeout(function() {

                                // Resize chart
                                NewVehiclesReadyForSaleChart.resize();
                                NewVehiclesSold.resize();
                                OldVehiclesSaleReady.resize();
                                OldVehiclesSold.resize();
                            }, 200);
                        }
                    });
                }
            );
        });
    </script>


    <script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
            $(".nav-tabs li").removeClass('active');
            $(this).parent().addClass('active');
        });
    });
</script>
@stop
