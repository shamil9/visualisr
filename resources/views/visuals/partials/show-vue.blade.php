<script>
    new Vue({
        el: '#content',
        data: {
            user: '{{ auth()->id() }}',
            visual: '{{ $visual->id }}',
            isActive: {{ ($visual->inFavorites() ? 'true' : 'false') }},
            tooltipMessage: {!! ($visual->inFavorites() ? '"Remove favorite"' : '"Add favorite"') !!},
            favoritesCount: '{{ $visual->favorites->count() }}',
            commentEditUrl: '{{ route('comments.store', $visual) }}',
            social: false,
            download: false,
            pageUrl: window.location.href,
            ratingValue: {{ $visual->userRating or 1 }},
            ratingItems: [
                { title: '5 Stars', value: 5 },
                { title: '4 Stars', value: 4 },
                { title: '3 Stars', value: 3 },
                { title: '2 Stars', value: 2 },
                { title: '1 Star', value: 1 }
            ]
        },
        methods: {
            submitRating: function ( rating ) {
                axios
                    .post('{{ route('ratings.store', $visual) }}', {
                        rating: rating,
                        visual: this.visual,
                    })
                    .then(function ( response ) {
                    }.bind(this))
                    .catch(function ( error ) {
                    }.bind(this));
            },
            submit: function () {
                axios
                    .post('{{ route('favorites.toggle') }}', {
                        user_id: this.user,
                        visual_id: this.visual,
                    })
                    .then(function ( response ) {
                        this.isActive       = !this.isActive;
                        this.tooltipMessage = 'Success';
                        this.favoritesCount = response.data;
                    }.bind(this))
                    .catch(function ( error ) {
                        this.tooltipMessage = 'Error! Cannot add favorite'
                    }.bind(this));
            },
            editComment: function ( body, id ) {
                return axios.patch(this.commentEditUrl + '/' + id, { body: body });
            },
            showSocial: function () {
                this.social   = !this.social;
                this.download = false;
            },
            showDownload: function () {
                this.social   = false;
                this.download = !this.download;
            },
            deleteComment: function ( event ) {
                event.preventDefault();
                event.target.parentNode.submit();
            }
        }
    });
</script>
