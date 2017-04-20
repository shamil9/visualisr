<div class="column is-4">
    <div class="visual">
        <div class="front">
            <a href="{{ route('visuals.show', $visual) }}">
                <img src="{{ asset('uploads/visuals/' . $visual->user_id . '/thumb_' . $visual->image) }}" alt="{{ $visual->track }}">
            </a>
        </div>
    </div>
</div>