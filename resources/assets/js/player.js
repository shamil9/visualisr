import 'howler'
import p5 from 'p5'
import Visualiser from './2dcanvas'
Vue.component('player', require('./components/Player.vue'))

export default class Player {
    constructor(song, format) {
        this.sound = new Howl({ src: [song], format: [format], volume: 0.5 })
        this.createAnalyser()
        this.position = null
        p5.disableFriendlyErrors = true
        this.visualiser = new Visualiser(new p5())
    }

    createAnalyser() {
        if (window.AudioContext || window.webkitAudioContext) {
            this.analyser = Howler.ctx.createAnalyser()
            this.analyser.fftSize = 128
            Howler.masterGain.connect(this.analyser)
            this.dataArray = new Uint8Array(this.analyser.frequencyBinCount)
            this.analyser.connect(Howler.ctx.destination)

            return true
        }

        return false
    }

    play(event) {
        if (this.sound.playing()) return
        this.sound.off()

        if (this.position) return this.sound.seek(this.position).play()

        this.sound.play()
        this.showVisualiser()
    }

    pause(event) {
        if (!this.sound.playing()) return

        this.sound.pause()
        return (this.position = this.sound._sounds[0]._seek)
    }

    jumpBack(event) {
        if (!this.sound.playing()) return

        this.sound.pause()
        this.position = this.sound._sounds[0]._seek - 5
        if (0 >= this.position) {
            this.position = null

            return this.sound.stop().play()
        }

        return this.sound.seek(this.position).play()
    }

    jumpForward(event) {
        if (!this.sound.playing()) return

        this.sound.pause()
        this.position = this.sound._sounds[0]._seek + 5

        if (this.position > this.sound._duration) {
            this.position = null
            return this.sound.stop()
        }

        return this.sound.seek(this.position).play()
    }

    reset() {
        this.visualiser.init()
    }

    showVisualiser() {
        requestAnimationFrame(this.showVisualiser.bind(this))
        if (!this.sound.playing()) return

        this.createAnalyser() && this.analyser.getByteTimeDomainData(this.dataArray)

        this.visualiser.show(this.dataArray)
    }
}
