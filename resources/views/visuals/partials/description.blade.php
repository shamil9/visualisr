<div class="columns">
    <div class="column is-8">
        <div class="media">
            <div class="media-left is-hidden-mobile">
                <figure class="user__avatar image is-48x48">
                    <img src="{{ asset(\Storage::url('avatars/' . $visual->user->avatar)) }}"
                         alt="{{ $visual->user->name }}">
                </figure>
            </div>

            <div class="media-right">
                <p class="title is-3">
                    <a href="{{ route('users.show', $visual->user->slug) }}">
                        {{ $visual->user->name }}
                    </a>
                </p>

                <div class="visual__actions">
                    <hr>
                    <span>
                        <a @click.prevent="showSocial" href="#">
                            <img src="{{ asset('assets/img/icons/share.svg') }}" alt="Share"> Share
                        </a>
                    </span>

                    <span>
                        <a @click.prevent="showDownload" href="#">
                            <img src="{{ asset('assets/img/icons/download.svg') }}" alt="Download Options"> Download
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div v-if="social" id="social" class="visual__actions">
            <span>
               <a :href="'https://www.facebook.com/sharer.php?u=' + pageUrl">
                   <img src="{{ asset('assets/img/icons/facebook.svg') }}" alt="Share on Facebook">
               Facebook</a>
            </span>

            <span>
               <a :href="'https://twitter.com/intent/tweet?url=' + pageUrl + '&text=Checkout this visual&via=Visualisr'">
                   <img src="{{ asset('assets/img/icons/twitter.svg') }}" alt="Share on Twitter">
               Twitter</a>
            </span>

            <span>
               <a :href="'https://plus.google.com/share?url=' + pageUrl">
                   <img src="{{ asset('assets/img/icons/google.svg') }}" alt="Share on Google+">
            Google+</a>
            </span>
        </div>

        <div v-if="download" id="download" class="visual__actions">
            <span>
               <a href="{{ asset(asset(getenv('APP_UPLOADS') . '/visuals/' . $visual->user_id . '/fb_' . $visual->image)) }}" download>
                   <img src="{{ asset('assets/img/icons/facebook.svg') }}" alt="Download Facebook Profile Banner">
               Facebook Banner</a>
            </span>

            <span>
               <a href="{{ asset(asset(getenv('APP_UPLOADS') . '/visuals/' . $visual->user_id . '/twitter_' . $visual->image)) }}" download>
                   <img src="{{ asset('assets/img/icons/twitter.svg') }}" alt="Download Twitter Profile Banner">
               Twitter Banner</a>
            </span>

            <span>
               <a href="{{ asset(asset(getenv('APP_UPLOADS') . '/visuals/' . $visual->user_id . '/' . $visual->image)) }}" download>
                   <img src="{{ asset('assets/img/icons/wallpaper.svg') }}" alt="Download Wallpaper">
            Wallpaper</a>
            </span>
        </div>
    </div>

    <div class="column is-4 is-hidden-mobile">
        <div class="stats">
            <p class="heading">Average Rating:</p>
            <p class="title is-5">{{ $visual->rating or 'No ratings yet' }}</p>

            <div class="columns is-mobile">
                <div class="column">
                    <p class="heading">Views:</p>
                    <p class="title is-5">{{ $visual->views }}</p>
                </div>

                <div class="column">
                    <p class="heading">Favorites:</p>
                    <p class="title is-5">@{{ favoritesCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
