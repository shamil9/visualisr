<template>
    <span>
        <modal v-if="showSubmitModal">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Save Visual</p>
                    <button class="delete" @click.prevent="toggleModal"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field has-addons">
                        <p class="control">
                            <button
                                :class="[errors.track ? 'is-danger' : 'is-outlined']"
                                disabled class="button" style="width: 75px">Track</button>
                        </p>
                        <p class="control is-expanded">
                            <input
                                v-model="localTrack"
                                :class="{'is-danger': errors.track}"
                                name="track" class="input" type="text" autofocus>
                        </p>
                    </div>
                    <b v-if="errors.track"
                        v-for="error in errors.track"
                        class="help is-danger">* {{ error }}</b>

                    <div class="field has-addons">
                        <p class="control">
                            <button
                                :class="[errors.album ? 'is-danger' : 'is-outlined']"
                                disabled class="button" style="width: 75px">Album</button>
                        </p>
                        <p class="control is-expanded">
                            <input
                                v-model="localAlbum"
                                :class="{'is-danger': errors.album}"
                                name="album" class="input" type="text">
                        </p>
                    </div>
                    <b v-if="errors.album"
                        v-for="error in errors.album"
                        class="help is-danger">* {{ error }}</b>

                    <div class="field has-addons">
                        <p class="control">
                            <button
                                :class="[errors.artist ? 'is-danger' : 'is-outlined']"
                                disabled class="button" style="width: 75px">Artist</button>
                        </p>
                        <p class="control is-expanded">
                            <input
                                v-model="localArtist"
                                :class="{'is-danger': errors.artist}"
                                name="artist" class="input" type="text">
                        </p>
                    </div>
                    <b v-if="errors.artist"
                        v-for="error in errors.artist"
                        class="help is-danger">* {{ error }}</b>

                </section>
                <footer class="modal-card-foot">
                    <a class="button"
                        @click.prevent="save"
                        :class="[{ 'is-loading': loading }, colorClass]"
                        :disabled="disabled"
                        >{{ submitMessage }}</a>
                    <a class="button" @click.prevent="toggleModal">Close</a>
                </footer>
            </div>
        </modal>
    </span>
</template>

<script>
    export default {
        props: ['url', 'track', 'album', 'artist', 'image'],
        mounted() {
            this.$parent.$on('toggleModalEvent', () => this.toggleModal())
        },
        data() {
            return {
                showSubmitModal: false,
                localTrack: this.track || null,
                localAlbum: this.album || null,
                localArtist: this.album || null,
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
                        image: this.image,
                        track: this.localTrack,
                        album: this.localAlbum,
                        artist: this.localArtist
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
                this.loading = true
                this.disabled = true
            },
            showError() {
                this.loading = false
                this.disabled = false
                this.submitMessage = 'Error! Try again?'
                this.colorClass = 'is-danger'
            },
            showSuccess() {
               this.loading = false
               this.disabled = true
               this.submitMessage = 'Saved! Redirecting...'
               this.colorClass = 'is-success'
               this.errors = {}
            },
            reset() {
                this.loading = false
                this.disabled = false
                this.errors = {}
                this.submitMessage = 'Save'
                this.colorClass = 'is-success'
            },
            redirectTo(response) {
                // when updating an visual the response should be empty, otherwise redirect url will be incorrect
                const redirectTo = `${this.url}/${response.data.id || ''}`
                setTimeout(() => window.location.href = redirectTo, 1500)
            }
        }
    }
</script>