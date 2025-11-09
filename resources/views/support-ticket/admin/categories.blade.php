@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Support Categories</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                <div role="group" class="btn-group">
                    <a href="#add-edit-category" data-id="0" data-toggle="modal" class="btn btn-outline-primary "><i class="ft-plus icon-left"></i> Add</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section class="basic-elements">
            <div class="row">
                @include('partials.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Categories</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($categories->count())
                                            <table class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Category Name</th>
                                                        <th>Create By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($categories as $category)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $category->name }}</td>
                                                            <td>{{ $category->user->full_name }}</td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-sm">
                                                                    <button data-toggle="modal" data-target="#add-edit-category" data-id="{{ $category->id }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                                                    <button data-toggle="modal" data-target="#delete-category" data-id="{{ $category->id }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No Support Category found.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade text-left" id="add-edit-category" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Category</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{!! route('support-ticket.categories.save') !!}" name="suport_category_form">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <label for="name">Category name: </label>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Category Name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="0">
                        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="delete-category" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Are You sure</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{!! route('support-ticket.categories.delete') !!}" name="category_delete_form">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <p>Are you sure you want to delete this category ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="0">
                        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        var Categories = {!! $categories->keyBy('id')->toJson() !!};
        $(document).ready(function (){
            $("#add-edit-category").on('show.bs.modal',function(ev){
                //console.log(ev);
                var id = $(ev.relatedTarget).data('id');
                console.log(id);
                if(id != 0){
                    if(Categories.hasOwnProperty(id)){
                        document.suport_category_form.name.value = Categories[id].name;
                        document.suport_category_form.id.value = Categories[id].id;
                    }else alert('Category not Found');
                }else{
                    document.suport_category_form.id.value = 0;
                }
            });

            $("#delete-category").on('show.bs.modal',function(ev){
                var id = $(ev.relatedTarget).data('id');
                if(Categories.hasOwnProperty(id)){
                    document.category_delete_form.id.value = Categories[id].id;
                }else alert('Category not Found');
            });
        })
    </script>
@endpush
