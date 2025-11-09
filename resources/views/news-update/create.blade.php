@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            @if($newsUpdates->exists)
                <h3 class="content-header-title mb-0">Edit News Update</h3>
            @else
                <h3 class="content-header-title mb-0">Create News Update</h3>
            @endif
        </div>
    </div>
    <div class="content-body">
        <section id="create-news-update">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::model($newsUpdates,['route'=>'news-update.create','files' => true]) !!}
                                        <div class="form-body">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                {!! Form::label('title','Title') !!}
                                                {!! Form::text('title',NULL,['class'=>'form-control border-primary','placeholder'=>"Subject"]) !!}
                                                @if($errors->has('title'))
                                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                                {!! Form::label('content','Content') !!}
                                                {!! Form::textarea('content',null,['class'=>'form-control border-primary tinymce','placeholder'=>'Type your message']) !!}
                                                @if($errors->has('content'))
                                                    <span class="help-block">{{ $errors->first('content') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-body" style="">
                                            <div class="form-group">
                                                <img id="img" src="{{ Storage::url($newsUpdates->image)}}" style="max-width:15em">
                                            </div>
                                        </div>

                                        <div class="form-body">
                                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                {!! Form::label('image','Image') !!}
                                                {!! Form::file('image',['onchange' =>'readURL(this)']) !!}

                                                @if($errors->has('image'))
                                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Save
                                            </button>
                                        </div>
                                        @if($newsUpdates->exists)
                                            {!! Form::hidden('id',$newsUpdates->id) !!}
                                        @endif
                                        {!! Form::close() !!}
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

@push('page-js')
    <script src="{{ asset('assets/js/scripts/tinymce/jquery.tinymce.js') }}"></script>
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        jQuery().ready(function() {
            jQuery('textarea.tinymce').tinymce({
                // Location of TinyMCE script
                script_url : '{{ asset('assets/js/scripts/tinymce/tiny_mce.js') }}',

                // General options
                theme : "advanced",
                skin : "themepixels",
                width: "100%",
                plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                inlinepopups_skin: "themepixels",
                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,blockquote,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,image,help,code,|,preview,|,forecolor,backcolor,removeformat,|,charmap,media,|,fullscreen",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "css/plugins/tinymce.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "lists/template_list.js",
                external_link_list_url : "lists/link_list.js",
                external_image_list_url : "lists/image_list.js",
                media_external_list_url : "lists/media_list.js",

                // Replace values for the template plugin
                template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
                }
            });


        });
    </script>
@endpush
