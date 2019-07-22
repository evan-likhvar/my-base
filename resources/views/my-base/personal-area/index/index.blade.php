@extends(config('settings.theme-views-personal-area').'.layout')
@section('content')
    <div class="uk-inline uk-width-1-1" uk-height-viewport="expand: true">
        <div class="uk-position-center uk-overlay uk-overlay-default">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">HI, {{ Auth::user()->name }}.<br />
                                Welcome to your Dashboard</div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                You are logged in!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--<ul>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

--}}{{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>--}}{{--
        </div>
    </li>
</ul>--}}
@endsection
