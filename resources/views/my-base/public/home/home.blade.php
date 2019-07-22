<div class="uk-grid-small uk-child-width-expand@s" uk-grid>
    <div class="uk-width-auto@m">
        {!! $categoryMenu !!}
    </div>
    <div class="uk-width-expand@m">
        @foreach($notes as $note)
            @include($settings['theme-views-public'].'.includes.note-item-index')
        @endforeach

            {{ $notes->links('vendor.pagination.semantic-ui') }}
    </div>
</div>

