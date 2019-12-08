import { Pixel } from './types'

export default class Layer {
    private rows: Pixel[][]
    private digits: {
        [digit: string]: number
    } = {}

    static Create(slice: Pixel[], height: number, width: number): Layer {
        const layer: Pixel[][] = []
        for (let i = 0; i < slice.length; i += width) {
            const row: Pixel[] = slice.slice(i, i + width)
            layer.push(row)
        }
        return new Layer(layer)
    }

    constructor(rows: Pixel[][]) {
        this.rows = rows
        this.countDigits()
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

    public getDigitCount(digit: Pixel): number {
        return this.digits[digit]
    }
}
