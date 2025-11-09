<div class="card">
    <div class="card-header">
        <h4 class="card-title">{!! $news->title !!}</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        @if(Gate::allows('only-admin'))
            <div class="heading-elements">
                <a href="{{ route('news-update.edit',$news->id) }}"><i class="fa fa-pencil fa-2x"></i></a>
                @if($deleteOption)
                    <span style="cursor: pointer" data-id="{{ $news->id }}" class="delete-news"><i class="fa fa-trash fa-2x"></i></span>
                @endif
            </div>
        @endif
    </div>

    @if($news->image)
        <div class="card-content collpase show">
            <div class="card-body">
                <div class="card-text">
                    <img src="{{ \Storage::url($news->image) }}">
                </div>
            </div>
        </div>
    @endif

    <div class="card-content collpase show">
        <div class="card-body">
            <div class="card-text">
                {!! $news->content !!}
            </div>
        </div>
    </div>


    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
        <span class="float-left">{!! $news->created_at->diffForHumans() !!}</span>
        <span class="tags float-right">
            <span class="badge badge-pill badge-primary">{!! $news->user->full_name !!}</span>
         </span>
    </div>
</div>
