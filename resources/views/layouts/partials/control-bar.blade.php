<div class="control-bar">
    <div class="container">
        <nav class="columns">
            <div class="column is-1">
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="column is-10 has-text-centered">
                @section('control-bar')
                    <p>Test</p>
                @show
            </div>
            <div class="column is-1 has-text-right">
                <span class="icon">
                    <a href="#">
                        <img src="{{ asset('assets/img/icons/sliders.svg') }}" alt="Edit">
                    </a>
                </span>
            </div>
        </nav>
    </div>
</div>