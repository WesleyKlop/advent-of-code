import { Pixel } from './Pixel'

export default class Layer {
    private readonly rows: Pixel[][]
    private digits: {
        [digit: string]: number
    } = {}

    constructor(rows: Pixel[][]) {
        this.rows = rows
        this.countDigits()
    }

    static Create(slice: Pixel[], height: number, width: number): Layer {
        const layer: Pixel[][] = []
        for (let i = 0; i < slice.length; i += width) {
            const row: Pixel[] = slice.slice(i, i + width)
            layer.push(row)
        }
        return new Layer(layer)
    }

    public getDigitCount(digit: Pixel): number {
        return this.digits[digit]
    }

    public getPixel(x: number, y: number): Pixel {
        return this.rows[y][x]
    }

    public merge(other: Layer): Layer {
        for (let y = 0; y < this.rows.length; y++) {
            const row = this.rows[y]
            for (let x = 0; x < row.length; x++) {
                const pixel = other.getPixel(x, y)
                switch (pixel) {
                    case Pixel.TRANS:
                        // Keep it this way
                        break
                    case Pixel.BLACK:
                        this.rows[y][x] = Pixel.BLACK
                        break
                    case Pixel.WHITE:
                        this.rows[y][x] = Pixel.WHITE
                        break
                    default:
                        throw new Error('Invalid pixel: ' + pixel)
                }
            }
        }
        return this
    }

    public toString() {
        return this.rows.reduce((str, curr) => {
            const prettyRow = curr
                .map(pixel => {
                    switch (pixel) {
                        case Pixel.WHITE:
                            return '█'
                        case Pixel.BLACK:
                            return '░'
                        case Pixel.TRANS:
                            return ' '
                    }
                })
                .join('')
            return `${str}\n${prettyRow}`
        }, '')
    }

    private countDigits() {
        this.rows.forEach(row =>
            row.forEach(value => {
                this.countDigit(value)
            }),
        )
    }

    private countDigit(digit: Pixel) {
        this.digits[digit] = (this.digits[digit] || 0) + 1
    }
}
