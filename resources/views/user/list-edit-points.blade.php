

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="margin-top: 5px;">
            Edit point for {{ $user->first_name }} {{ $user->last_name }}
        </h1>
    </div>
    <div class="col-lg-12" style="margin-top: 20px; padding-top: 20px">
        <form action="{{ route('list.edit-point',$user->id) }}" method="post" id="" >
            {{ csrf_field() }}

            <div class="col-lg-2" style="text-align: right;"><label>Points:</label></div>
            <div class="col-lg-6">
                <input class="form-control" type="text" name="points" value="{{ $user->details->fld_points }}">
            </div>
            <div class="col-lg-4">
            <input type="submit" value="Update Points" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>




