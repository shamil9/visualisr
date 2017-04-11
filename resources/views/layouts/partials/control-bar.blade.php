<div class="control-bar">
    <div class="container">
        <nav class="columns">
            <div class="column is-1">
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="column is-10 has-text-centered">
                @section('control-bar')
                @show
            </div>
            <div class="column is-1 has-text-right">
                <span>
                    <a href="#">
                        <img src="{{ asset('assets/img/icons/user/sliders.svg') }}" alt="Edit">
                    </a>
                </span>
            </div>
        </nav>
    </div>
</div>