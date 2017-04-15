export default class VisualManager {
    constructor(url) {
        this.visualizer = document.querySelector('#visualizer');
        this.url = url;
        // this.addEventListeners();
    }

    addEventListeners() {
        this.saveButton.addEventListener('click', this.submitImage.bind(this));
    }

    submitImage(event) {
        // event.preventDefault();
        window.axios
            .post('/visuals', {
                image: this.visualizer.toDataURL(),
                track: this.trackInput.value,
                album: this.albumInput.value,
                artist: this.artistInput.value
            })
            .then(response => console.log(response))
            .catch(error => console.log(error));
    }
}