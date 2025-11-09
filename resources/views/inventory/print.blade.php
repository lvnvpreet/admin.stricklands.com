@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <h2 style="margin-bottom: 20px;">Print Inventory Lists</h2>
    <form action="{{ route('inventory.print-preview') }}" method="get" class="row" target="_blank">
        <div class="col-12 top-search">
            <div style="float:left; width: 150px;">
                {{ Form::select('location', $locations,@$_GET['location'], ['class' => 'select2 col-12']) }}
            </div>
            <div style="float:left; width: 125px; margin-left: 5px;">
                {{ Form::select('inventory', $inventories, @$_GET['inventory'], ['class' => 'select2 col-12']) }}
            </div>
            <div style="float:left; width: 100px;margin-left: 5px;">
                {{ Form::select('type', $types, @$_GET['type'], ['class' => 'select2 col-12']) }}
            </div>
            <div style="float:left; width: 120px;margin-left: 5px;">
                <select class="select2 col-12" name="price">
                    <option value="180000"  <?php if (!(strcmp(180000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>All Prices</option>
                    <option value="30000" <?php if (!(strcmp(30000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $30,000</option>
                    <option value="25000" <?php if (!(strcmp(25000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $25,000</option>
                    <option value="20000" <?php if (!(strcmp(20000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $20,000</option>
                    <option value="15000" <?php if (!(strcmp(15000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $15,000</option>
                    <option value="10000" <?php if (!(strcmp(10000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $10,000</option>
                    <option value="5000" <?php if (!(strcmp(5000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $5,000 </option>
                </select>
            </div>
            <div style="float:left; width: 120px;margin-left: 5px;">
                <select class="select2 col-12" name="kms">
                    <option value="all"  <?php if (!(strcmp("All", @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>All KM's</option>
                    <option value="50000" <?php if (!(strcmp(50000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 50,000</option>
                    <option value="75000" <?php if (!(strcmp(75000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 75,000</option>
                    <option value="100000" <?php if (!(strcmp(100000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 100,000</option>
                    <option value="125000" <?php if (!(strcmp(125000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 125,000</option>
                    <option value="150000" <?php if (!(strcmp(150000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 150,000</option>
                    <option value="200000" <?php if (!(strcmp(200000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 200,000 </option>
                </select>
            </div>

            <div style="float:left; width: 100px;margin-left: 5px;">
                <select class="select2 col-12" name="year">
                    <option value="all">All Years</option>
                    @for($y=date('Y');$y>=(date('Y')-20);$y--)
                        <option <?php if (!(strcmp($y, @$_GET['year']))) {echo "selected=\"selected\"";} ?> value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div style="float:left; width: 130px;margin-left: 5px;">
                {{ Form::select('make', $makes, @$_GET['make'], ['class' => 'select2 col-12']) }}
            </div>

            <div style="float:left; width: 120px;margin-left: 5px;">
                <input type="text" class="form-control" placeholder="Model" name="model" value="{{ @$_GET['model'] }}">
            </div>

            <div style="float:left; width: 100px;margin-left: 5px;">
                <input type="text" class="form-control" placeholder="Stock #" name="stock" value="{{ @$_GET['stock'] }}">
            </div>
            <div style="float:left; width: 100px;margin-left: 5px;">
                <input type="submit" class="btn btn-primary" value="Filter">
            </div>


        </div>
    </form>


@stop
