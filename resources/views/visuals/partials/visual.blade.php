<div class="column is-3">
    <div class="visual">
        <div class="front">
            <a href="{{ route('visuals.show', ['visual' => $visual->id]) }}">
                <img src="{{ $visual->image }}" alt="{{ $visual->track }}">
            </a>
        </div>
    </div>
</div>