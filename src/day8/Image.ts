import Layer from './Layer'

export default class Image {
    private readonly width: number
    private readonly height: number
    private layers: Layer[] = []

    constructor(width: number, height: number) {
        this.width = width
        this.height = height
    }

    public addLayer(layer: Layer) {
        this.layers.push(layer)
    }

    public getLayers() {
        return this.layers
    }

    public decode(): string {
        return this.layers
            .reverse()
            .reduce((prev, curr) => {
                if (!prev) {
                    return curr
                }

                return prev.merge(curr)
            })
            .toString()
    }
}
