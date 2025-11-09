@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">New Vehicles</h2>
            </div>
            <div class="card-body">
                <h5>For Sale - Ready</h5>
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
                    <td>{{ $newreadycars = $vehicles['C']->where('fldStatusCode','N')->where('fldKey1','<>','P')->count() }}</td>
                    <td>{{ $newreadysuvs = $vehicles['S']->where('fldStatusCode','N')->where('fldKey1','<>','P')->count() }}</td>
                    <td>{{ $newreadyvans = $vehicles['V']->where('fldStatusCode','N')->where('fldKey1','<>','P')->count() }}</td>
                    <td>{{ $newreadytrucks = $vehicles['T']->where('fldStatusCode','N')->where('fldKey1','<>','P')->count() }}</td>
                    <td>{{ $newreadycars + $newreadysuvs + $newreadyvans + $newreadytrucks }} </td>
                </tr>
                </tbody>
            </table>

            <h4>Sold</h4>
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
                    <td>{{ $newsoldcars = $vehicles['C']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}</td>
                    <td>{{ $newsoldsuvs = $vehicles['S']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}</td>
                    <td>{{ $newsoldvans = $vehicles['V']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}</td>
                    <td>{{ $newsoldtrucks = $vehicles['T']->where('fldStatusCode','N')->where('fldKey1','P')->count() }}</td>
                    <td>{{ $newsoldcars + $newsoldsuvs + $newsoldvans + $newsoldtrucks }} </td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">USED VEHICLES</h2>
            </div>
            <div class="card-body">
                <h5>For Sale - Ready</h5>
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
                        <td>{{ $newreadycars = $vehicles['C']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}</td>
                        <td>{{ $newreadysuvs = $vehicles['S']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}</td>
                        <td>{{ $newreadyvans = $vehicles['V']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}</td>
                        <td>{{ $newreadytrucks = $vehicles['T']->where('fldStatusCode','<>','N')->where('fldKey1','<>','P')->count() }}</td>
                        <td>{{ $newreadycars + $newreadysuvs + $newreadyvans + $newreadytrucks }} </td>
                    </tr>
                    </tbody>
                </table>

                <h4>Sold</h4>
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
                        <td>{{ $newsoldcars = $vehicles['C']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}</td>
                        <td>{{ $newsoldsuvs = $vehicles['S']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}</td>
                        <td>{{ $newsoldvans = $vehicles['V']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}</td>
                        <td>{{ $newsoldtrucks = $vehicles['T']->where('fldStatusCode','<>','N')->where('fldKey1','P')->count() }}</td>
                        <td>{{ $newsoldcars + $newsoldsuvs + $newsoldvans + $newsoldtrucks }} </td>
                    </tr>
                    </tbody>
                </table>
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
