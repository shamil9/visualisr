@can('create', App\Comment::class)
    <form method="post" action="{{ route('comments.store', $visual) }}">
        {{ csrf_field() }}
        <article class="media">
            <figure class="media-left">
                <div class="comment__avatar">
                    <img src="{{ asset(\Storage::url('avatars/' . $visual->user->avatar)) }}" alt="{{ $visual->user->name }}">
                </div>
            </figure>

            <div class="media-content">
                <div class="field has-addons">
                    <p class="control is-expanded">
                        <input name="body" maxlength="180" minlength="2" class="input relative is-primary" type="text" placeholder="Add Comment">
                    </p>

                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <img src="{{ asset('assets/img/icons/user/comment.svg') }}" alt="Add Comment">
                        </button>
                    </p>
                </div>
            </div>
        </article>
    </form>
    <br>
@endcan

@foreach($comments as $comment)
    @include('comments.partials.comment', ['comment' => $comment, 'visual' => $visual])
@endforeach
{{ $comments->links() }}

