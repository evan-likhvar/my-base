@extends($settings['theme-views-public'].'.layout')

@section('left-side')
    @if(!empty($leftSide))
        {!! $leftSide !!}
    @endif
@endsection

@section('content')
    @if(!empty($content))
        {!! $content !!}
    @endif
@endsection
