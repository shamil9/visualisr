<template>
    <modal v-show="showModal" v-cloak>
        <div class="modal-card">
            <div class="modal-content">
                <article class="message is-danger has-text-centered">
                    <div class="message-header">
                        <p><strong>Danger</strong>!</p>
                    </div>
                    <div class="message-body">
                        <p class="title is-2 is-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>
                        <p class="title is-3 is-danger">This operation is irreversible!</p>
                        <button class="button is-danger" @click.prevent="deleteTicket">Delete</button>
                        <button @click.prevent="showModal = !showModal" class="button">Cancel</button>
                    </div>
                </article>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    mounted() {
        this.$parent.$on('showDeleteModalEvent', id => this.showDeleteModal(id));
    },
    data() {
        return {
            showModal: false,
            formId: null
        };
    },
    methods: {
        showDeleteModal(id) {
            this.formId = id;
            this.showModal = true;
        },
        deleteTicket() {
            this.$parent.$refs[this.formId].submit();
        }
    }
};
</script>
