<div class="column is-4">
    <div class="card">
        <div class="card-image">
            <figure class="image is-16by9">
                @if (isset($user->visuals->last()->image))
                    <img src="{{ asset(getenv('APP_UPLOADS') . '/visuals/' . $user->id . '/thumb_' . $user->visuals->last()->image) }}"
                         alt="{{ $user->visuals->last()->track }}">
                @else
                    <img src="http://bulma.io/images/placeholders/640x360.png" alt="User has no visuals">
                @endif
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="user__avatar image is-48x48">
                        <img src="{{ asset(getenv('APP_UPLOADS') . '/avatars/' . $user->avatar) }}"
                             alt="{{ $user->name }}">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">{{ $user->name }}</p>
                    <p class="subtitle is-6">Visuals: {{ $user->visuals->count() }}</p>
                </div>
            </div>

            <div class="content has-text-centered">
                <small>Joined: {{ $user->created_at->diffForHumans() }}</small>
                |
                <small>Last Update: {{ $user->updated_at->diffForHumans() }}</small>
            </div>
        </div>
        @can('manage', App\User::class)
            <footer class="card-footer">
                <form @click="submit" style="flex: 1" method="post" action="{{ route('users.toggle.status', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    @if ($user->banned)
                        <a href="#" class="user__unblock card-footer-item">Unblock</a>
                    @else
                        <a href="#" class="user__block card-footer-item">Block</a>
                    @endif
                </form>
                <form ref="{{ $user->id }}" style="flex: 1" method="post" action="{{ route('users.destroy', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a @click.prevent="$emit('showModalEvent', {{ $user->id }})" class="user__delete card-footer-item">Delete</a>
                </form>
            </footer>
        @endcan
    </div>
</div>
