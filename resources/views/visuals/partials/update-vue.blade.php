<script>
    new Vue({
        el: '#visual-edit',
        data: {
            showDeleteModal: false,
            private: {{ $visual->private }},
            display: 'none',
        },
        methods: {
            toggleModal: function() {
                this.showDeleteModal = !this.showDeleteModal;
            },
            submit: function() {
                document.getElementById('delete-form').submit();
           },
           togglePrivate: function() {
                window.axios
                    .post('{{ route('visuals.update.post', $visual) }}', {
                        image: '{{ $visual->image }}',
                        track: '{{ $visual->track }}',
                        album: '{{ $visual->album }}',
                        artist: '{{ $visual->artist }}',
                        private: !this.private,
                    })
                    .then(response => {
                    })
                    .catch(error => {
                    });
           }
        }
    });
</script>