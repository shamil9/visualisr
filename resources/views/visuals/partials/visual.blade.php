<div class="column is-4">
    <div class="visual">
        <div class="front">
            <a href="{{ route('visuals.show', ['visual' => $visual->id]) }}">
                <img src="{{ asset('uploads/visuals/' . $visual->user->id . '/thumb_' . $visual->image) }}" alt="{{ $visual->track }}">
            </a>
        </div>
    </div>
</div>