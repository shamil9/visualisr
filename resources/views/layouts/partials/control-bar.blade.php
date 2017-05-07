<div class="control-bar">
    <div class="container">
        <nav class="columns">
                <div class="column is-2" style="line-height: 50px;">
                    @yield('breadcrumbs')
                </div>
            <div class="column">
                @section('control-bar')
                @show
            </div>
            <div class="column is-1 has-text-right" style="line-height: 50px;">
            @if(Auth::check())
                <span>
                    <a href="{{ route('user.home') }}">
                        <img src="{{ asset('assets/img/icons/user/sliders.svg') }}" alt="Edit">
                    </a>
                </span>
            @endif
            </div>
        </nav>
    </div>
</div>
