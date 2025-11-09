@extends('layouts.app')

@section('page-title', trans('menu.vehicle-logistics.'))

@section('content')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-7 col-12 ">
            <h3 class="content-header-title mb-0">Checked-in Vehicle | <?php echo $location; ?> Location</h3>
        </div>
    </div>
    <div class="content-body">
        <section id="vehicle-logistics">
            <div class="row">
                @include('partials.messages')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="bd-example">
                                        <table class="table table-bordered table-hover table-responsive-lg mb-0" id="checkin-vehicles">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#Stock NO</th>
                                                    <th scope="col">Cleaned</th>
                                                    <th scope="col">Pictured</th>
                                                    <th scope="col">Safetied</th>
                                                    <th scope="col">E-tested</th>
                                                </tr>
                                            </thead>
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
@endsection

@section('scripts')
    
    <script>
        $(document).ready(function(){
            $("#checkin-vehicles").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('vehicle-logistics.checkin-vehicles') }}',
                createdRow: function ( row, data, index ) {
                    if(data.cleaned == 'Yes'){
                        $('td', row).eq(1).addClass('bg-success bg-lighten-4');
                    }
                    else
                    {
                       $('td', row).eq(1).addClass('bg-danger bg-lighten-4'); 
                    }
                    if(data.pictured == 'Yes'){
                        $('td', row).eq(2).addClass('bg-success bg-lighten-4');
                    }
                    else
                    {
                       $('td', row).eq(2).addClass('bg-danger bg-lighten-4'); 
                    }
                    if(data.safetied == 'Yes'){
                        $('td', row).eq(3).addClass('bg-success bg-lighten-4');
                    }
                    else
                    {
                       $('td', row).eq(3).addClass('bg-danger bg-lighten-4'); 
                    }
                    if(data.etested == 'Yes'){
                        $('td', row).eq(4).addClass('bg-success bg-lighten-4');
                    }
                    else
                    {
                       $('td', row).eq(4).addClass('bg-danger bg-lighten-4'); 
                    }
                },
                "order": [[ 4, "desc" ]],
                columns: [
                    {data: 'stock_no', name: 'stock_no',  orderable: true, searchable: true},
                    {data: 'cleaned', name: 'cleaned',orderable: false, searchable: false},
                    {data: 'pictured', name: 'pictured',orderable: false, searchable: false},
                    {data: 'safetied', name: 'safetied',orderable: false, searchable: false},
                    {data: 'etested', name: 'etested',orderable: false, searchable: false}
                ]
            });
        });
    </script>

@endsection
