<article class="media comment">
    <figure class="media-left">
    <div class="comment__avatar">
            <img src="{{ asset(getenv('APP_UPLOADS') . '/avatars/' . $visual->user->avatar) }}" alt="{{ $visual->user->name }}">
        </div>
    </figure>
    <div class="media-content">
        <div class="box">
            @can('update', $comment)
                <comment body="{{ $comment->body }}" id="{{ $comment->id }}" />
            @else
                {{ $comment->body }}
            @endcan
        </div>
    </div>
</article>