<script>
    new Vue({
        el: '#visual-edit',
        data: {
            private: {{ $visual->private }},
            display: 'none',
        },
        methods: {
           togglePrivate: function() {
                window.axios
                    .post('{{ route('visuals.update.post', $visual) }}', {
                        image: '{{ $visual->image }}',
                        track: '{{ $visual->track }}',
                        album: '{{ $visual->album }}',
                        artist: '{{ $visual->artist }}',
                        private: !this.private,
                    })
                    .then(function (response) { this.private = !this.private }.bind(this))
                    .catch(function (error) {});
           }
        }
    });
</script>
