<div class="header">
    <div class="container">
        <div class="header__logo is-pulled-left">
            <a href="{{ url('/') }}">
                <img src="{{ url('assets/img/logo.png') }}" title="{{ env('APP_NAME') }}" />
            </a>
        </div>
        <div class="header__user is-pulled-right">
            @if (Auth::guest())
                <div class="header__user--guest">
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </a>
                </div>
            {{--@else--}}
                {{--<div class="header__user--user">--}}

                {{--</div>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                        {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                    {{--</a>--}}

                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('logout') }}"--}}
                               {{--onclick="event.preventDefault();--}}
                                                                 {{--document.getElementById('logout-form').submit();">--}}
                                {{--Logout--}}
                            {{--</a>--}}

                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            @endif
        </div>
    </div>
</div>

