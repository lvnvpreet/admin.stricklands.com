<div class="card">
    <div class="card-content">
        <div class="card-header">
            <h4 class="card-title">
                Comments
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('support-ticket.comment',[$ticket->id]) }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <fieldset class="form-group position-relative mb-0">
                    <div class="input-group">
                        {{-- <input type="text" id="new-note" name="comment" class="form-control col-12" width="100%" placeholder="Add new note">--}}
                        <textarea id="new-note" name="comment" class="form-control col-12" rows="5" placeholder="Add new note"></textarea>
                        {{--<span class="input-group-btn col-auto p-0">
                          <button id="add-note" class="btn btn-primary " style="padding: 6px 10px" type="submit"><i class="fa fa-comment"></i></button>
                        </span>--}}
                    </div>
                    <div class="input-group mt-2">
                        <input type="file" name="file[]" multiple>
                    </div>
                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-comment"></i> Comment</button>
                    </div>
                </fieldset>
            </form>
        </div>
        {{-- @if(!$ticket->is_closed) --}}
        <div class="card-footer px-0 py-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if($ticket->comments()->count())
                            @foreach($ticket->comments()->latest()->get() as $comment)

                                <div class="media">
                                    <div class="media-left">
                                    <span class="avatar">
                                        <img src="{{ $comment->user->gravatar() }}" alt="avatar"><i></i></span>
                                        </span>
                                    </div>
                                    <div class="media-body">

                                        <p class="mb-0"><span class="text-bold-600">{{ $comment->user->full_name }}</span>
                                            <small data-toggle="tooltip" data-title="{{ $comment->created_at->format('j M, Y @ h:i a') }}">on <b>{{ $comment->created_at->format('j M, Y') }}</b></small> 
                                            <i id="edit{{$comment->id}}" data-content="{{ $comment->comment }}" style="cursor: pointer;" class="{{ Auth::id() == $comment->user_id ? 'fa fa-pencil-square-o pull-right' : ''}}" onclick="comment( {{ $comment->id }});">
                                            </i>
                                            <i id="save{{$comment->id}}" class="{{ Auth::id() == $comment->user_id ? 'fa fa-save pull-right' : ''}}" onclick="saveComment({{ $comment->id }});" style="display: none; cursor: pointer">
                                            </i>
                                        </p>
                                        <p id="cmnt{{ $comment->id }}" class="mb-0">{!! nl2br($comment->comment) !!}</p>
                                        @if($comment->file)
                                            @php $files = explode(',',$comment->file); @endphp
                                            @foreach($files as $key=>$file)
                                                <div style="float:left; margin:5px;">
                                                    <a href="{{ \Storage::url($file) }}" target="_blank">
                                                        <img src="{{ \Storage::url($file) }}" class="comment-{{$comment->id}}-image-{{$key}}" style="border: 1px solid black; margin-bottom: 5px;"  width="80" height="80">
                                                    </a>
                                                <br><i onclick="deleteCommentImage({{$comment->id}},{{$key}});" data-file="{{$file}}" class="fa fa-trash comment-{{$comment->id}}-button-{{$key}} comment-{{$comment->id}} pull-center comment-{{$comment->id}}-image-{{$key}}" style="display:none;"> </i>
                                                </div>
                                            @endforeach
                                        @endif
                                            <div class="input-group col-md-12 mt-2 mb-2" style="display:none;float:left;" id="image-field-{{$comment->id}}">
                                            <input type="file" name="comment-{{$comment->id}}-files[]" multiple id="comment-{{$comment->id}}-files">
                                            </div>
                                        <textarea class="form-control col-12" id="commentBox{{ $comment->id }}" name="comment"  rows="5" style="display: none"></textarea>
                                        
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr style="margin-left:-20px; margin-right: -20px " />
                                @endif
                            @endforeach
                        @else
                            <p>No Comments for this ticket.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
    </div>
</div>
@push('page-js')
    <script type="text/javascript">
        /*function showImage(imagePath){
            window.open(imagePath,'_blank');
        }*/
            function comment(commentId) {
                let Comment = $("#edit"+commentId).data('content');
                $('#cmnt'+commentId).css('display', 'none');
                $('#edit'+commentId).css('display', 'none');
                $('#save'+commentId).css('display', 'block');
                $(".comment-"+commentId).css('display','block');
                $("#image-field-"+commentId).css('display','block');
                $('#commentBox'+commentId).css('display', 'block');
                $('#commentBox'+commentId).text(Comment);
            }

            function saveComment(commentId) {
                let imgData = new FormData();
                let uid = "{{ Auth::user()->id }}";
                let comment = $('#commentBox'+commentId).val();
                imgData.append('uid',uid); 
                imgData.append('comment',comment);
                imgData.append('commentId',commentId);
                
                let images = $('#comment-'+commentId+'-files')[0].files;
                for(let i in images){
                    imgData.append('image'+i,images[i]);
                }
                
                
                $.ajax({
                    cache:false,
                    contentType:false,
                    processData:false,
                    method:"POST",
                    url:"{{ route('support-ticket.comment.change') }}",
                    data:imgData,
                    success:function(data){

                        $('#cmnt'+commentId).css('display', 'block');
                        $('#commentBox'+commentId).css('display', 'none');
                        $('#edit'+commentId).css('display', 'block');
                        $('#save'+commentId).css('display', 'none');
                        $("#image-field-"+commentId).css('display','none');
                        $(".comment-"+commentId).css('display','none');
                        $('#cmnt'+commentId).html(comment.replace(/(\r\n|\n\r|\r|\n)/g, "<br>"));
                    },
                    error:function(errorResponse){
                        console.log(errorResponse);
                    },
                });

            }

            function deleteCommentImage(commentId,key){
                let imageIndex = key;
                let file = event.target.dataset.file;
                $.ajax({
                    url: "{{ url('support-ticket/delete-comment-image') }}",
                    type: "GET",
                    data : {
                        commentId : commentId,
                        file: file,
                    },
                    success: function(res){
                        if(res.message ==true){
                            $('.comment-'+commentId+'-image-'+imageIndex).remove();
                            $('.comment-'+commentId+'-button-'+imageIndex).remove();
                        }else{
                            console.log('Error! Please try again.');
                        }
                    },
                    error : function(error){
                        console.log('Error! Please try again.');
                    }
                });
            }
    </script>
@endpush
