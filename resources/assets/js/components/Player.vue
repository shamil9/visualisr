<template>
    <div class="player">
        <div class="player__seek-back" @click.prevent="jumpBack">
            <a id="seek-back" href="#" title="Seek back 5sec">
            <img src="/assets/img/icons/player/seek-back.svg" alt="Seek back 5sec">
        </a>
        </div>

        <div class="player__play" @click.prevent="play">
            <a id="play" href="#" title="Play">
                <svg width="35px" height="35px" viewBox="0 0 35 35" :class="{'player--active': isPlaying}" class="player__button">
                    <g id="Visual-Player">
                        <g id="Layout" transform="translate(-517.000000, -96.000000)">
                            <g id="Control-bar" transform="translate(0.000000, 90.000000)">
                                <g id="Player" transform="translate(377.000000, 4.000000)">
                                    <path d="M157.142878,2.57139111 C166.607175,2.57139111 174.285755,10.2499717 174.285755,19.7142687 C174.285755,29.1785657 166.607175,36.8571463 157.142878,36.8571463 C147.678581,36.8571463 140,29.1785657 140,19.7142687 C140,10.2499717 147.678581,2.57139111 157.142878,2.57139111 Z M165.714316,20.9419487 C166.160745,20.6964127 166.428603,20.2276622 166.428603,19.7142687 C166.428603,19.2008752 166.160745,18.7321247 165.714316,18.4865886 L153.571445,11.343723 C153.147337,11.0758655 152.589301,11.0758655 152.142872,11.3214015 C151.696443,11.589259 151.428585,12.0580096 151.428585,12.571403 L151.428585,26.8571343 C151.428585,27.3705278 151.696443,27.8392784 152.142872,28.1071358 C152.366086,28.2187431 152.611622,28.2857075 152.857158,28.2857075 C153.102694,28.2857075 153.34823,28.2187431 153.571445,28.0848144 L165.714316,20.9419487 Z" class="play-path"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>

        <div class="player__pause" @click.prevent="pause">
            <a id="pause" href="#" title="Pause">
                <svg width="18px" height="18px" viewBox="0 0 18 18" :class="{'player--active': isPaused}" class="player__button">
                    <g id="Visual-Player">
                        <g id="Layout" transform="translate(-562.000000, -105.000000)">
                            <g id="Control-bar" transform="translate(0.000000, 90.000000)">
                                <g id="Player" transform="translate(377.000000, 6.000000)">
                                    <path d="M202.142878,9.99998212 C202.142878,9.60935665 201.819216,9.28569555 201.428591,9.28569555 L195.714298,9.28569555 C195.323673,9.28569555 195.000012,9.60935665 195.000012,9.99998212 L195.000012,25.7142866 C195.000012,26.104912 195.323673,26.4285731 195.714298,26.4285731 L201.428591,26.4285731 C201.819216,26.4285731 202.142878,26.104912 202.142878,25.7142866 L202.142878,9.99998212 Z M192.142866,9.99998212 C192.142866,9.60935665 191.819205,9.28569555 191.428579,9.28569555 L185.714287,9.28569555 C185.323661,9.28569555 185,9.60935665 185,9.99998212 L185,25.7142866 C185,26.104912 185.323661,26.4285731 185.714287,26.4285731 L191.428579,26.4285731 C191.819205,26.4285731 192.142866,26.104912 192.142866,25.7142866 L192.142866,9.99998212 Z" id="pause---FontAwesome"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>

        <div class="player__seek-forward" @click.prevent="jumpForward">
            <a id="seek-forward" href="#" title="Seek Forward 5sec">
                <img src="/assets/img/icons/player/seek-forward.svg" alt="Seek Forward 5sec">
            </a>
        </div>

        <div class="player__save" @click.prevent="toggleModal" :data-balloon="saveMessage" data-balloon-pos="right">
            <a id="save" href="#" title="Save">
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
                format: 'mp3',
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
                this.format = /\/(.*)/.exec(this.$parent.format)[1]
                this.play()
            },
        }
    }
</script>
