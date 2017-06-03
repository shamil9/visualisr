<div class="control-bar">
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-narrow" style="line-height: 50px;">
                @yield('breadcrumbs')
            </div>
            <div class="column">
                @section('control-bar')
                @show
            </div>
            <div class="column has-text-right is-narrow" style="line-height: 50px;">
            @if(Auth::check())
                 @if (! auth()->user()->active)
                    <span class="tag is-warning is-small
                        @if(\Route::currentRouteName() == 'visuals.show') is-hidden-mobile @endif"
                        style="vertical-align: middle">Unconfirmed Account</span>
                @endif
                <a href="{{ route('user.home') }}">
                    <img src="{{ asset('assets/img/icons/user/sliders.svg') }}" alt="Edit">
                </a>
            @endif
            </div>
        </div>
    </div>
</div>
