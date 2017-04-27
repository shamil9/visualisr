<template>
    <transition name="flash">
        <div class="flash notification is-success" v-show="visible">
            {{ body }}
        </div>
    </transition>
</template>
<script>
    export default {
        props: ['message'],
        mounted() {
            EventBus.$on('flash', message => this.show(message))
        },
        created() {
            if (this.message)
                this.show(this.message)
        },
        methods: {
            show(message) {
                this.body = message
                this.visible = true
                this.hide()
            },
            hide() {
                setTimeout(() => this.visible = false, 3000)
            }
        },
        data() {
            return {
                body: this.message,
                visible: false,
            }
        }
    }
</script>
