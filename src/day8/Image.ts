import Layer from './Layer'

export default class Image {
    private readonly width: number
    private readonly height: number
    private layers: Layer[] = []

    private size(): number {
        return this.width * this.height
    }

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
}
