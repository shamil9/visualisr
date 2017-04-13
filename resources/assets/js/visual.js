class Visualiser {
    static init() {
        this.canvas = document.querySelector('#visualizer')
        this.canvas.width = 1900;
        this.canvas.height = 1080;
        this.canvasCtx = this.canvas.getContext('2d')
    }
    static showData(dataArray) {
        const WIDTH = this.canvas.width;
        const HEIGHT = this.canvas.height;
        this.canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);

        let barWidth = WIDTH / 1024;
        let barHeight;
        let x = 0;
        // Draw the time domain chart.
        for (let i = 0; i < 1024; i++) {
            // let value = dataArray[ i ]
            // let percent = value / 256;
            // console.log(value)
            // let height = HEIGHT * percent;
            // let offset = HEIGHT - height - 1;
            // let barWidth = WIDTH/analyser.frequencyBinCount;
            // canvasCtx.fillStyle = 'dark';
            // ctx.fillRect(x, y, width, height)
            // canvasCtx.fillRect(i, 1, 1, value);
            barHeight = dataArray[ i ] * 5

            this.canvasCtx.fillStyle = 'black'
            this.canvasCtx.fillRect(x, HEIGHT - barHeight, barWidth, 5)

            x += barWidth
        }
    }
}

export default Visualiser
