class Visualiser {
    constructor(p5) {
        this.p5 = p5
        this.canvas = document.querySelector('#visualizer')
        this.width = this.canvas.offsetWidth
        this.height = this.canvas.offsetHeight
        this.t = 0
        this.alpha = 0.01
        this.init()
    }

    init() {
        this.p5.clear()
        this.p5.createCanvas(1300, 500).parent('#visualizer')
        this.p5.strokeWeight(2)
        this.p5.stroke(`hsla(144, 80%, 50%, ${this.alpha})`)
        this.A = this.p5.random(this.width / 2.2)
        this.B = this.p5.random(this.height / 2.2)
        this.a = this.p5.round(this.p5.random(9)) + 1
        this.b = this.p5.round(this.p5.random(9)) + 1

        this.A2 = this.p5.random(this.width / 2.2)
        this.B2 = this.p5.random(this.height / 2.2)
        this.a2 = this.p5.round(this.p5.random(9)) + 1
        this.b2 = this.p5.round(this.p5.random(9)) + 1
        this.t = 0
    }

    update(dataArray) {
        let hue = dataArray[4] > 70 ? dataArray[4] : 158
        this.p5.stroke(`hsla(${this.p5.round(hue)}, 100%, 50%, ${this.alpha})`)
    }

    show(dataArray) {
        if (this.t >= 5) {
            this.init()
            return
        }

        let steps = 5
        for (let i = 0; i < steps; i++) {
            let x0 = this.A * this.p5.sin(this.a2 * this.t) + this.width / 2
            let y0 = this.B * this.p5.sin(this.b2 * this.t) + this.height / 2
            let x1 = this.A2 * this.p5.sin(this.a * this.t + this.p5.PI) + this.width / 2
            let y1 = this.B2 * this.p5.sin(this.b * this.t + this.p5.PI) + this.height / 2

            this.p5.line(x0, y0, x1, y1)
            this.t += 0.003
            this.update(dataArray)
        }
    }
}

export default Visualiser
