<script>
    new Vue({
        el: '#content',
        data: {
            user: '{{ auth()->id() }}',
            visual: '{{ $visual->id }}',
            isActive: {{ ($visual->inFavorites() ? 'true' : 'false') }},
            tooltipMessage: 'Favorites: ' + {{ $visual->favorites_count }}
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
                        this.tooltipMessage = 'Favorites: ' + response.data;
                    }.bind(this))
                    .catch(function(error) {
                        this.tooltipMessage = 'Error! Cannot add favorite.'
                    }.bind(this));
            }
        }
    });
</script>