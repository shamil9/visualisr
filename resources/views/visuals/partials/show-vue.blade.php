<script>
    new Vue({
        el: '#content',
        data: {
            user: '{{ auth()->id() }}',
            visual: '{{ $visual->id }}',
            isActive: {{ ($visual->inFavorites() ? 'true' : 'false') }},
        },
        methods: {
            submit: function () {
                axios
                    .post('{{ route('favorites.store') }}',{
                        user_id: this.user,
                        visual_id: this.visual,
                    })
                    .then(response => {
                        this.isActive = !this.isActive;
                    })
                    .catch();
            }
        }
    });
</script>