@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Add Delivery</h3>
        </div>
    </div>
    <div class="content-body">
        <div class="basic-elements">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="step-1">
                        <div class="card-header">
                            <div class="card-title">Add Delivery</div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="get">
                                    <div class="form-body">
                                        <h4 class="form-section">
                                            Step #1
                                        </h4>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                <fieldset class="form-group position-relative">
                                                    <label for="location">Select Location#</label>
                                                    <select class="form-control" id="location" name="location">
                                                        @foreach($locations as $location)
                                                            <option value="{{ $location->id }}">{{ $location->fldLocationName }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                <fieldset class="form-group">
                                                    <label for="stock_no">Stock #</label>
                                                    <input placeholder="stock #" type="text" class="form-control" name="stock_no" id="stock_no">
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1 pt-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ft-plus"></i> Add
                                                </button>
                                                <button type="button" class="btn btn-warning mr-1" id="cancel-button">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#cancel-button').on('click',function(){
            swal({
                title:'Are You Sure ?',
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location.href = '{{ route('delivery-schedule',5) }}';
              } else {
                
              }
            })
        });

        @if($errors->any())
            $(document).ready(function(){
                var ErrorList = "<ul>";
                @foreach($errors->all() as $mes)
                    ErrorList += "<li>{{ $mes }}</li>";
                @endforeach
                    ErrorList += "</ul>";

                swal({
                    title:'Validation Error',
                    text:ErrorList,
                    icon:'warning',
                    html:true,
                })

            });

        @endif
    </script>
@endsection
