export default class Box {
    getWrappingRibbon(): number {
        return (
            (this.length +
                this.width +
                this.height -
                Math.max(this.length, this.width, this.height)) *
            2
        )
    }

    getBowRibbon(): number {
        return this.length * this.width * this.height
    }
    getRequiredWrapping(): number {
        return this.getSurfaceArea() + this.getSlack()
    }

    getRequiredRibbon(): number {
        return this.getWrappingRibbon() + this.getBowRibbon()
    }

    getSlack(): number {
        return Math.min(
            this.getSurface1(),
            this.getSurface2(),
            this.getSurface3(),
        )
    }

    constructor(
        private readonly length: number,
        private readonly width: number,
        private readonly height: number,
    ) {}

    getSurface1() {
        return this.length * this.width
    }

    getSurface2() {
        return this.width * this.height
    }

    getSurface3() {
        return this.height * this.length
    }

    getSurfaceArea(): number {
        return (
            2 * this.getSurface1() +
            2 * this.getSurface2() +
            2 * this.getSurface3()
        )
    }
}
