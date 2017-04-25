<article class="media comment">
    <figure class="media-left">
    <div class="comment__avatar">
            <img src="{{ asset(getenv('APP_UPLOADS') . '/avatars/' . $visual->user->avatar) }}" alt="{{ $visual->user->name }}">
        </div>
    </figure>
    <div class="media-content">
        <div class="box">
            {{ $comment->body }}
        </div>
    </div>
</article>