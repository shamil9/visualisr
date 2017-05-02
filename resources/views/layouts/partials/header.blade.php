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
                    <span class="tag is-info">Beta</span>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <div class="header__nav">
                        <ul>
                            <li><a href="{{ route('visuals.index') }}">Visuals</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
@include('layouts.partials.control-bar')

