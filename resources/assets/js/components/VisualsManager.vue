<template>
    <span>
        <modal v-if="showSubmitModal">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Save Visual</p>
                    <button class="delete" @click.prevent="toggleModal" :disabled="disabled"></button>
                </header>

                <section class="modal-card-body">
                    <div class="field is-horizontal">
                        <div :class="[errors.track ? 'field-label is-danger' : 'field-label is-normal']">
                            <label class="label">Track</label>
                        </div>

                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icon">
                                    <input
                                            v-model="visual.track"
                                            :class="{'is-danger': errors.track}"
                                            name="track" class="input" type="text" autofocus>

                                    <span class="icon is-small is-left">
                                        <i class="fa fa-music"></i>
                                    </span>
                                </p>

                                <p v-if="errors.track"
                                   v-for="error in errors.track"
                                   class="help is-danger">* {{ error }}</p>
                            </div>
                        </div>
                    </div>

                     <div class="field is-horizontal">
                        <div :class="[errors.album ? 'field-label is-danger' : 'field-label is-normal']">
                            <label class="label">Album</label>
                        </div>

                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icon">
                                    <input
                                            v-model="visual.album"
                                            :class="{'is-danger': errors.album}"
                                            name="album" class="input" type="text" autofocus>

                                    <span class="icon is-small is-left">
                                        <i class="fa fa-dot-circle-o"></i>
                                    </span>
                                </p>

                                <p v-if="errors.album"
                                   v-for="error in errors.album"
                                   class="help is-danger">* {{ error }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div :class="[errors.artist ? 'field-label is-danger' : 'field-label is-normal']">
                            <label class="label">Artist</label>
                        </div>

                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icon">
                                    <input
                                            v-model="visual.artist"
                                            :class="{'is-danger': errors.artist}"
                                            name="artist" class="input" type="text" autofocus>

                                    <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </p>

                                <p v-if="errors.artist"
                                   v-for="error in errors.artist"
                                   class="help is-danger">* {{ error }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="modal-card-foot">
                    <a class="button"
                       @click.prevent="save"
                       :class="[{ 'is-loading': loading }, colorClass]"
                       :disabled="disabled"
                    >{{ submitMessage }}</a>
                    <a class="button" @click.prevent="toggleModal" :disabled="disabled">Close</a>
                </footer>
            </div>
        </modal>
    </span>
</template>

<script>
    export default {
        props: [ 'url', 'entity', 'image' ],
        mounted() {
            this.$parent.$on('toggleModalEvent', () => this.toggleModal())
        },
        data() {
            return {
                showSubmitModal: false,
                visual: this.entity || {},
                loading: false,
                disabled: false,
                submitMessage: 'Save Visual',
                colorClass: 'is-success',
                errors: {}
            }
        },
        methods: {
            toggleModal() {
                this.showSubmitModal = !this.showSubmitModal
                this.reset()
                EventBus.$emit('pauseEvent')
            },
            save() {
                this.showLoadingSpiner()
                window.axios
                    .post(this.url, {
                        image: this.image || this.visual.image,
                        track: this.visual.track,
                        album: this.visual.album,
                        artist: this.visual.artist
                    })
                    .then(response => {
                        this.showSuccess()
                        this.redirectTo(response)
                    })
                    .catch(error => {
                        this.showError()
                        this.errors = error.response.data
                    })
            },
            showLoadingSpiner() {
                this.loading  = true
                this.disabled = true
            },
            showError() {
                this.loading       = false
                this.disabled      = false
                this.submitMessage = 'Error! Try again?'
                this.colorClass    = 'is-danger'
            },
            showSuccess() {
                this.loading       = false
                this.disabled      = true
                this.submitMessage = 'Saved! Redirecting...'
                this.colorClass    = 'is-success'
                this.errors        = {}
            },
            reset() {
                this.loading       = false
                this.disabled      = false
                this.errors        = {}
                this.submitMessage = 'Save'
                this.colorClass    = 'is-success'
            },
            redirectTo( response ) {
                // when updating an visual the response should be empty, otherwise redirect url will be incorrect
                const redirectTo = `${this.url}/${response.data.id || ''}`
                setTimeout(() => window.location.href = redirectTo, 1500)
            }
        }
    }
</script>
