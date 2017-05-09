<template>
    <div>
        <p v-show="!isEditing">
            <a @click.prevent="isEditing = !isEditing" href="#">{{ commentBody }}</a>
        </p>
        <div v-if="isEditing">
            <div class="field has-addons">
                <p class="control is-expanded">
                    <input v-model="commentBody"
                            @keyup.enter="submit"
                            @keyup.esc="isEditing = !isEditing"
                            class="input" type="text" autofocus>
                </p>
                <p class="control">
                    <a @click.prevent="submit" class="button is-primary">Submit</a>
                </p>
            </div>
            <p v-if="errors.body" v-for="error in errors.body" class="help is-danger">{{ error }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['body', 'id', 'comments'],
    mounted() {
        console.log(this.comments)
    },
    data() {
        return {
            isEditing: false,
            commentBody: this.body,
            foo: this.comments,
            errors: {},
        }
    },
    methods: {
        submit() {
            this.$root.editComment(this.commentBody, this.id)
                .then(response => {
                    this.isEditing = !this.isEditing
                    this.errors = {}
                    this.commentBody = response.data
                    flash('Comment edited with success')
                })
                .catch(error => {
                    this.errors = error.response.data
                })
        }
    }
}
</script>
