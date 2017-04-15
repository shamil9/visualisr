<template>
    <div class="player">
        <div class="player__seek-back "  @click.prevent="jumpBack">
            5sec<a id="seek-back" href="#">
                <img src="/assets/img/icons/player/seek-back.svg" alt="Seek back 5sec">
            </a>
        </div>

        <div class="player__play" @click.prevent="play">
            <a id="play" href="#">
                <svg width="35px" height="35px" viewBox="0 0 35 35">
                   <use :class="{'player--active': isPlaying}" class="player__button" xlink:href="/assets/img/icons/player/play.svg#Layout"></use>
                </svg>
            </a>
        </div>

        <div class="player__pause" @click.prevent="pause">
            <a id="pause" href="#">
                <svg width="18px" height="18px" viewBox="0 0 18 18">
                   <use :class="{'player--active': isPaused}" class="player__button" xlink:href="/assets/img/icons/player/pause.svg#Layout"></use>
                </svg>
            </a>
        </div>

        <div class="player__seek-forward" @click.prevent="jumpForward">
            <a id="seek-forward" href="#">
                <img src="/assets/img/icons/player/seek-forward.svg" alt="Seek Forward 5sec">
            </a>5sec
        </div>

        <div class="player__save" @click.prevent="$emit('toggleModalEvent')">
            <a id="save" href="#">
                <img src="/assets/img/icons/user/camera.svg" alt="Save">
            </a>
        </div>

        <manager :url="url"></manager>
    </div>
</template>

<script>
    import Player from '../player'
    export default {
        mounted() {
            this.$on('pauseEvent', () => this.pause())
        },
        props: ['url'],
        data() {
            return {
                player: new Player(),
                isPlaying: false,
                isPaused: false
            }
        },
        methods: {
            play() {
                this.isPlaying = true
                this.isPaused = false
                this.player.play()
            },
            pause() {
                this.isPlaying = false
                this.isPaused = true
                this.player.pause()
            },
            jumpBack() {
                this.player.jumpBack()
            },
            jumpForward() {
                this.player.jumpForward()
            },
        }
    }
</script>
