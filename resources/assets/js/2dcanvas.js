class Visualiser {
    constructor ( p5 ) {
        p5.disableFriendlyErrors = true
        this.p5                  = p5
        this.canvas              = document.querySelector('#visualizer')
        this.width               = this.canvas.offsetWidth
        this.height              = this.canvas.offsetHeight
        this.modifier            = 0
        this.speed               = 10
        this.paused              = false
        this.data                = [8]
        this.p5.frameRate(30)
        this.p5.createCanvas(this.width, this.height).parent('#visualizer')
        this.init()
    }

    init () {
        this.p5.clear()
        this.p5.background('#f5f5f5')
        this.color = this.p5.round(this.p5.random(360))
        this.p5.strokeWeight(1)
        this.alpha = 0.01
        this.p5.stroke(`hsla(${this.color}, 80%, 50%, ${this.alpha})`)
        const number = Math.floor(this.data.reduce((a, b) => a + b) / this.data.length)

        this.randomX = this.p5.random(this.width / 2.2)
        this.randomY = this.p5.random(this.height / 2.2)
        this.randomx = this.p5.random(number / 10)
        this.randomy = this.p5.random(number / 10)


        this.randomX2 = this.p5.random(this.width / 2.2)
        this.randomY2 = this.p5.random(this.height / 2.2)
        this.randomx2 = this.p5.random(number / 10)
        this.randomy2 = this.p5.random(number / 10)
        this.modifier = 0
        this.paused   = false
    }

    delay ( time ) {
        if ( !this.paused ) {
            this.paused = true
            setTimeout(() => this.init(), time * 1000)
        }
    }

    show ( dataArray ) {

        if ( this.modifier >= 5 ) {
            this.data = dataArray
            this.delay(3)
            return
        }

        if ((this.modifier).toFixed(2) == 5 / 2) {
            let color = Math.floor(this.p5.random(360))
            this.p5.stroke(`hsla(${color}, 80%, 50%, ${this.alpha})`)
        }

        for ( let i = 0; i < this.speed; i++ ) {
            let startX = this.randomX * this.p5.sin(this.randomx2 * this.modifier) + this.width / 2
            let startY = this.randomY * this.p5.sin(this.randomy2 * this.modifier) + this.height / 2
            let stopX  = this.randomX2 * this.p5.sin(this.randomx * this.modifier + this.p5.PI) + this.width / 2
            let stopY  = this.randomY2 * this.p5.sin(this.randomy * this.modifier + this.p5.PI) + this.height / 2

            this.p5.line(startX, startY, stopX, stopY)
            this.modifier += 0.001
        }
    }
}

export default Visualiser
