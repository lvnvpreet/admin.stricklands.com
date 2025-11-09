@extends('layouts.app')

@section('page-title', 'Manage Payments'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Manage Payments</h3>
        </div>
        @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager'))
        <div class="content-header-right col-md-6 col-12">
            <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                <div role="group" class="btn-group">
                    <a href="{{ route('payment.show') }}" class="btn btn-outline-primary "><i class="ft-plus icon-left"></i> Add Payment</a>
                </div>
            </div>
        </div>
        @endif
    </div>

@include('partials.messages')


<div class="content-body">
    <section id="open-tickets">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <table id="table" class="table table-bordered table-responsive-lg table-hover payments-datatable">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Store</th>
                                                <th>Code</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->product }}</td>
                                                    <td>{{ $payment->store->fldLocationName }}</td>
                                                    <td>{{ $payment->code }}</td>
                                                    <td>{{ $payment->address }}</td>
                                                    <td>{{ $payment->city }}</td>
                                                    <td>{{ $payment->postal }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('payment.edit',$payment->id) }}" class="btn btn-primary btn-circle"
                                                           title="Edit payment" data-toggle="tooltip" data-placement="top">
                                                            <i class="glyphicon glyphicon-edit"></i>
                                                        </a>

                                                        <a href="{{ route('payment.delete',$payment->id) }}" class="btn btn-primary btn-circle"
                                                           title="Delete payment" data-toggle="tooltip" data-placement="top" onclick="if(confirm('Are you sure want to delete this.') == false) { return false;}">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.payments-datatable').DataTable({
                "order": [[ 3, "desc" ],[2,'desc']]
            });
        });    
    </script>
@stop
