<comment inline-template :entity="{{ $comment }}"
        url="{{ route('comments.update', ['visual' => $visual, 'comment' => $comment]) }}">
    <article class="comment__content">
        <div class="box">
            @can('update', $comment)
                <div>
                    <p v-show="!isEditing">
                        <a @click.prevent="isEditing = !isEditing" href="#">
                            @{{ body }}
                        </a>
                    </p>

                    <div v-if="isEditing">
                        <div class="field has-addons">
                            <p class="control is-expanded">
                                <input v-model="body"
                                        @keyup.enter="submit"
                                        @keyup.esc="isEditing = !isEditing"
                                        class="input" type="text" autofocus>
                            </p>

                            <p class="control">
                                <a @click.prevent="submit" class="button is-primary">
                                    Submit
                                </a>
                            </p>
                        </div>

                        <p v-if="errors.body" v-for="error in errors.body" class="help is-danger">
                            @{{ error }}
                        </p>
                    </div>
                </div>
            @else
                {{ $comment->body }}
            @endcan
        </div>

        <div class="pull-right">
            <span class="has-text-right comment__info">
                <delete-modal v-cloak></delete-modal>
                By <a href="{{ route('users.show', ['slug' => $comment->user->slug]) }}" title="Visit {{ $comment->user->name }} profile">{{ $comment->user->name }}</a>
                {{ $comment->created_at->diffForHumans() }}
                @can('destroy', App\Comment::class)
                    <a
                        class="comment__delete"
                        @click.prevent="$emit('showDeleteModalEvent', 'comment-{{ $comment->id }}')"
                        href="#">
                        Delete
                    </a>
                    <form method="post" ref="comment-{{ $comment->id }}"
                          action="{{ route('comments.destroy',
                                    ['visual' => $visual, 'comment' => $comment])
                                }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                @endcan
            </span>
        </div>
        <br>
    </article>
</comment>
