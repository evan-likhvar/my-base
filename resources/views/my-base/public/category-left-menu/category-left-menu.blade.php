<ul class="uk-nav uk-nav-default">
    @foreach($categories as $category)
        <li @if($category->name === $active) class="uk-active" @endif><a href="{{route('category.index',[$category->name,$locale])}}">{{$category->name}}</a></li>
    @endforeach
</ul>