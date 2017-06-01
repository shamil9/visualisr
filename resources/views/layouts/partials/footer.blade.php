<div class="container">
    <div class="level is-mobile">
        <div class="level-left is-hidden-mobile">
            <p>{{ config('app.name') }} 2017</p>
        </div>
        <div class="level-right">
            <div class="level-item">
                <a href="{{ route('contact.create') }}">Contact</a>
            </div>
            <div class="level-item">
                <a href="{{ route('faq') }}">FAQ</a>
            </div>
            <div class="level-item">
                <a href="{{ route('tos') }}">Terms of service</a>
            </div>
        </div>
    </div>
</div>
