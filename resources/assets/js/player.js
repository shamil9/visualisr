const howler = require('howler');
import Visualiser from './visual';

export default class Player {
    constructor() {
        this.sound = new Howl({ src: ['/assets/song.mp3'], volume: 0.5 });
        this.analyser = Howler.ctx.createAnalyser();
        Howler.masterGain.connect(this.analyser);
        this.dataArray = new Uint8Array(this.analyser.frequencyBinCount);
        this.analyser.connect(Howler.ctx.destination);
        this.position = null;
        Visualiser.init();
        // this.addEventListeners();
    }

    addEventListeners() {
        this.playButton.addEventListener('click', this.play.bind(this));
        this.pauseButton.addEventListener('click', this.pause.bind(this));
        this.seekForwardButton.addEventListener('click', this.jumpForward.bind(this));
        this.seekBackButton.addEventListener('click', this.jumpBack.bind(this));
        this.saveButton.addEventListener('click', this.pause.bind(this));
    }

    play(event) {
        if (this.sound.playing()) return;
        this.sound.off();

        if (this.position) return this.sound.seek(this.position).play();

        this.sound.play();
        this.showVisualiser();
    }

    pause(event) {
        if (!this.sound.playing()) return;

        this.sound.pause();
        return (this.position = this.sound._sounds[0]._seek);
    }

    jumpBack(event) {
        if (!this.sound.playing()) return;

        this.sound.pause();
        this.position = this.sound._sounds[0]._seek - 5;
        if (0 >= this.position) {
            this.position = null;

            return this.sound.stop().play();
        }

        return this.sound.seek(this.position).play();
    }

    jumpForward(event) {
        if (!this.sound.playing()) return;

        this.sound.pause();
        this.position = this.sound._sounds[0]._seek + 5;

        if (this.position > this.sound._duration) {
            this.position = null;
            return this.sound.stop();
        }

        return this.sound.seek(this.position).play();
    }

    showVisualiser() {
        requestAnimationFrame(this.showVisualiser.bind(this));
        if (!this.sound.playing()) return;

        this.analyser.getByteFrequencyData(this.dataArray);

        Visualiser.showData(this.dataArray);
    }
}
