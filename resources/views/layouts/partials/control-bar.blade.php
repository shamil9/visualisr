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
            <div class="column is-2 has-text-right" style="line-height: 50px;">
            @if(Auth::check())
                 @if (! auth()->user()->active)
                    <span class="tag is-warning is-small" style="vertical-align: middle">Unconfirmed Account</span>
                @endif
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
