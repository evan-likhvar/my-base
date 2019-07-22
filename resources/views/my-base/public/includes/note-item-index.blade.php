<div class="uk-card uk-card-default uk-margin-top">
{{--    <div class="uk-card-header">
        <div class="uk-width-expand">
            <p class="uk-text-meta uk-margin-remove-top">
                <time datetime="2016-04-01T19:00">{{$note->published_at}}</time>
            </p>
        </div>
    </div>--}}
    <div class="uk-card-body">
        <div class="uk-card-badge uk-label">Badge</div>
        <time datetime="2016-04-01T19:00">{{$note->published_at}}</time>
        <h3 class="uk-card-title">{{$note->title}}</h3>
        {!! $note->note !!}
    </div>
    <div class="uk-card-footer">
        <a href="{{route('note.show',[$note->id,$locale])}}" class="uk-button uk-button-text">Read more</a>
    </div>
</div>