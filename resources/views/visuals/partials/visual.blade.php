<div class="column is-4">
    <div class="card">
        <div class="card-image">
            <figure class="image is-16by9">
                <a href="{{ route('visuals.show', $visual->visual_id ?: $visual) }}">
                    <img src="{{ asset(\Storage::url('/visuals/' . $visual->user_id . '/thumb_' . $visual->image)) }}"
                         alt="{{ $visual->track }}">
                </a>
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="user__avatar image is-48x48">
                        <img src="{{ asset(\Storage::url('avatars/' . $visual->user->avatar)) }}"
                             alt="{{ $visual->user->name }}">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">
                        <a href="{{ route('users.show', $visual->user->slug) }}">
                            {{ $visual->user->name }}
                        </a>
                    </p>
                    <p class="subtitle is-6">{{ $visual->updated_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="content">
                Track: {{ $visual->track }} <br>
                Album: {{ $visual->album }} <br>
                Artist: {{ $visual->artist }} <br>
            </div>
        </div>
        <footer class="card-footer">
            <span class="card-footer-item">
                <i class="fa fa-comments" aria-hidden="true">
                    {{ $visual->comments_count }}
                </i>
            </span>
            <span class="card-footer-item">
                <i class="fa fa-heart" aria-hidden="true">
                    {{ $visual->favorites_count }}
                </i>
            </span>
            <span class="card-footer-item">
                <i class="fa fa-star" aria-hidden="true">
                    {{ $visual->rating or 'Not rated' }}
                </i>
            </span>
        </footer>
    </div>
</div>
