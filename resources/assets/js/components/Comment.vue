<template>

</template>
<script>
    export default {
        props: [ 'entity', 'url' ],
        data() {
            return {
                isEditing: false,
                comment: this.entity,
                body: this.entity.body,
                errors: {},
            }
        },
        methods: {
            submit() {
                axios.patch(this.url, { body: this.body })
                    .then(response => {
                        this.isEditing = !this.isEditing
                        this.errors    = {}
                        this.comment   = response.data
                        flash('Comment edited with success')
                    })
                    .catch(error => {
                        this.errors = error.response.data
                    })
            }
        }
    }
</script>
