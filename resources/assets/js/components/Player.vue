<template>
    <div class="player">
        <div class="player__seek-back" @click.prevent="jumpBack">
            5sec<a id="seek-back" href="#">
            <img src="/assets/img/icons/player/seek-back.svg" alt="Seek back 5sec">
        </a>
        </div>

        <div class="player__play" @click.prevent="play">
            <a id="play" href="#">
                <svg width="35px" height="35px" viewBox="0 0 35 35">
                    <use :class="{'player--active': isPlaying}" class="player__button"
                         xlink:href="/assets/img/icons/player/play.svg#Layout"></use>
                </svg>
            </a>
        </div>

        <div class="player__pause" @click.prevent="pause">
            <a id="pause" href="#">
                <svg width="18px" height="18px" viewBox="0 0 18 18">
                    <use :class="{'player--active': isPaused}" class="player__button"
                         xlink:href="/assets/img/icons/player/pause.svg#Layout"></use>
                </svg>
            </a>
        </div>

        <div class="player__seek-forward" @click.prevent="jumpForward">
            <a id="seek-forward" href="#">
                <img src="/assets/img/icons/player/seek-forward.svg" alt="Seek Forward 5sec">
            </a>5sec
        </div>

        <div class="player__save" @click.prevent="toggleModal" :data-balloon="saveMessage" data-balloon-pos="right">
            <a id="save" href="#">
                <img src="/assets/img/icons/user/camera.svg" alt="Save">
            </a>
        </div>

        <manager :url="url" :image="image"></manager>
    </div>
</template>

<script>
    import Player from '../player'
    export default {
        mounted() {
            EventBus.$on('pauseEvent', () => this.pause())
            EventBus.$on('changeSongEvent', () => this.changeSong())
            this.$root.$on('resetEvent', () => this.player.reset())
        },
        props: [ 'url' ],
        data() {
            return {
                isPlaying: false,
                isPaused: false,
                image: null,
                song: '/assets/song.mp3',
                format: 'audio/mp3',
                saveMessage: 'Please start playback first'
            }
        },
        computed: {
            player() {
                return new Player(this.song, this.format)
            },
            visualizer() {
                return document.querySelector('#visualizer')
            }
        },
        methods: {
            play() {
                this.isPlaying          = true
                this.isPaused           = false
                this.$root.showDropArea = false
                this.saveMessage        = 'Save the visual'
                this.player.play()
            },
            pause() {
                this.isPlaying = false
                this.isPaused  = true
                this.player.pause()
            },
            jumpBack() {
                this.player.jumpBack()
                this.player.reset()
            },
            jumpForward() {
                this.player.jumpForward()
                this.player.reset()
            },
            toggleModal() {
                if ( this.visualizer.children.length ) {
                    this.image = this.visualizer.children[ 0 ].toDataURL()
                    this.$emit('toggleModalEvent')
                }
            },
            changeSong() {
                this.pause()
                this.visualizer.removeChild(this.visualizer.children[ 0 ])
                this.song   = this.$parent.song
                this.format = this.$parent.format
                this.play()
            },
        }
    }
</script>
