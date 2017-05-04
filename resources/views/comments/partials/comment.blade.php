<article class="media comment">
    <figure class="media-left">
        <div class="comment__avatar">
            <img src="{{ asset(getenv('APP_UPLOADS') . '/avatars/' . $visual->user->avatar) }}" alt="{{ $visual->user->name }}">
        </div>
    </figure>
    <div class="media-content comment__content">
        <div class="box">
            @can('update', $comment)
                <comment body="{{ $comment->body }}" id="{{ $comment->id }}"></comment>
            @else
                {{ $comment->body }}
            @endcan
        </div>
        @can('destroy', App\Comment::class)
            <div class="has-text-right comment__info">
                <form method="post"
                      action="{{ route('comments.destroy',
                                ['visual' => $visual, 'comment' => $comment]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    {{ $comment->created_at->diffForHumans() }}
                    <a @click.prevent="deleteComment" href="#">Delete</a>
                </form>
            </div>
        @endcan
    </div>
</article>
