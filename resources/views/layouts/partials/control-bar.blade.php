<div class="control-bar">
    <div class="container">
        <nav class="columns">
            @if(Auth::check())
                <div class="column is-2" style="line-height: 50px;">
                    <span>{{ auth()->user()->name }}</span>
                </div>
            @endif
            <div class="column">
                @section('control-bar')
                @show
            </div>
            <div class="column is-1 has-text-right" style="line-height: 50px;">
                <span>
                    <a href="#">
                        <img src="{{ asset('assets/img/icons/user/sliders.svg') }}" alt="Edit">
                    </a>
                </span>
            </div>
        </nav>
    </div>
</div>