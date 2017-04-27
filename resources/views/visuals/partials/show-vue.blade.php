<script>
    new Vue({
        el: '#content',
        data: {
            user: '{{ auth()->id() }}',
            visual: '{{ $visual->id }}',
            isActive: {{ ($visual->inFavorites() ? 'true' : 'false') }},
            tooltipMessage: {!! ($visual->inFavorites() ? '"Remove favorite"' : '"Add favorite"') !!},
            favoritesCount: '{{ $visual->favorites_count }}',
            commentEditUrl: '{{ route('comments.store', $visual) }}',
            social: false,
            download: false,
            pageUrl: window.location.href,
        },
        methods: {
            submit: function () {
                axios
                    .post('{{ route('favorites.toggle') }}',{
                        user_id: this.user,
                        visual_id: this.visual,
                    })
                    .then(function(response) {
                        this.isActive = !this.isActive;
                        this.tooltipMessage = 'Success';
                        this.favoritesCount = response.data;
                    }.bind(this))
                    .catch(function(error) {
                        this.tooltipMessage = 'Error! Cannot add favorite'
                    }.bind(this));
            },
            editComment: function(body, id) {
                return axios.patch(this.commentEditUrl + '/' + id, { body: body });
            },
            showSocial: function () {
                this.social = !this.social;
                this.download = false;
            },
            showDownload: function () {
                this.social = false;
                this.download = !this.download;
            }
        }
    });
</script>