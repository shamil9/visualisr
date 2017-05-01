<div class="column is-4">
    <div class="visual">
        <div class="front">
            <a href="{{ route('visuals.show', $visual->visual_id ?: $visual) }}">
                <img src="{{ asset('uploads/visuals/' . $visual->user_id . '/thumb_' . $visual->image) }}" alt="{{ $visual->track }}">
            </a>
            {{ $visual->comments->count() }}
        </div>
    </div>
</div>
