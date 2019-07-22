<div class="uk-grid-small uk-child-width-expand@s" uk-grid>
    <div class="uk-width-auto@m">
        {!! $categoryMenu !!}
    </div>
    <div class="uk-width-expand@m">
        <article class="uk-article uk-text-justify">

            <h1 class="uk-article-title"><a class="uk-link-reset" href="">{{$note->title}}</a></h1>

            <p class="uk-article-meta">Written by <a href="#">Super User</a> on 12 April 2012. Posted in <a href="#">Blog</a>
            </p>

            <p class="uk-text-lead">{{$note->owner_note_comment}}</p>

            <p>{!! $note->content !!}</p>

            <div class="uk-grid-small uk-child-width-auto" uk-grid>
                <div>
                    <a class="uk-button uk-button-text" href="#">Read more</a>
                </div>
                <div>
                    <a class="uk-button uk-button-text" href="#">5 Comments</a>
                </div>
            </div>
        </article>
    </div>
    <div class="uk-width-1-4@m">
        <ul class="uk-nav uk-nav-default">
            @foreach($note->category->limitNotes(10) as $item)
                <li><a href="{{route('note.show',[$item->id,$locale])}}">{{$item->title}}</a></li>
            @endforeach
        </ul>
    </div>
</div>

