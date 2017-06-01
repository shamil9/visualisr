<div class="control-bar">
    <div class="container">
        <div class="columns is-mobile">
                <div class="column is-half-mobile" style="line-height: 50px;">
                    @yield('breadcrumbs')
                </div>
            <div class="column is-hidden-mobile">
                @section('control-bar')
                @show
            </div>
            <div class="column is-half-mobile has-text-right" style="line-height: 50px;">
            @if(Auth::check())
                 @if (! auth()->user()->active)
                    <span class="tag is-warning is-small" style="vertical-align: middle">Unconfirmed Account</span>
                @endif
                <a href="{{ route('user.home') }}">
                    <img src="{{ asset('assets/img/icons/user/sliders.svg') }}" alt="Edit">
                </a>
            @endif
            </div>
        </div>
    </div>
</div>
