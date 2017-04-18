export default class VisualManager {
    constructor(url) {
        this.visualizer = document.querySelector('#visualizer')
        this.url = url
    }

    submitImage(event) {
        window.axios
            .post(this.url, {
                image: this.visualizer.toDataURL(),
                track: this.trackInput.value,
                album: this.albumInput.value,
                artist: this.artistInput.value
            })
            .then(response => console.log(response))
            .catch(error => console.log(error))
    }
}
