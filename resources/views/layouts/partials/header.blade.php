<div class="header">
    <div class="container">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <div class="header__logo is-pulled-left">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo.svg') }}" title="{{ env('APP_NAME') }}" />
                        </a>
                    </div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <div class="header__nav">
                        <ul>
                            <li><a href="">Visuals</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="level-item">
                    <div class="header__user is-pulled-right">
                        <div class="header__user--guest">
                            <a href="{{ route('login') }}">
                                <img src="{{ asset('assets/img/icons/user/user.svg') }}" alt="User">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                        {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                    {{--</a>--}}

                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li>--}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--@endif--}}
    </div>
</div>
@include('layouts.partials.control-bar')

