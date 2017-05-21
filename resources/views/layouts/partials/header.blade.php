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
                    <span class="tag is-primary">Beta</span>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <span class="tag is-primary">
                        <a class="header__create" href="{{ route('visuals.create') }}">Create</a>
                    </span>
                </div>
                <div class="level-item">
                    <div class="header__nav">
                        <ul>
                            <li>
                                <a href="{{ route('visuals.index') }}">Visuals</a>
                            </li>

                            <li><a href="{{ route('blog.index') }}">Blog</a></li>

                            @if (auth()->check())
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        >Sign Out</a>
                                    <img src="{{ asset('assets/img/icons/sign-out.svg') }}" alt="Sign Out">
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">Sign In</a>
                                    <img src="{{ asset('assets/img/icons/sign-in.svg') }}" alt="Sign In">
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
@include('layouts.partials.control-bar')

