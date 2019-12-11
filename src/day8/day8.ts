import Layer from './Layer'
import Image from './Image'
import { Pixel } from './Pixel'
import { readInput } from '../utils'
import Program from '../Program'

// Load and parse the input file
const inputIntList = readInput('day8.txt')
    .split('')
    .map(e => parseInt(e, 10)) as Pixel[]

const LAYER_WIDTH = 25
const LAYER_HEIGHT = 6
const LAYER_SIZE = LAYER_WIDTH * LAYER_HEIGHT

export default class Day8 implements Program {
    public readonly label = 'Day 8'

    private readonly image: Image

    constructor() {
        this.image = new Image(LAYER_WIDTH, LAYER_HEIGHT)
        for (let i = 0; i < inputIntList.length; i += LAYER_SIZE) {
            const slice = inputIntList.slice(i, i + LAYER_SIZE)

            const layer = Layer.Create(slice, LAYER_HEIGHT, LAYER_WIDTH)
            this.image.addLayer(layer)
        }
    }

    async partOne() {
        const lowest = this.image.getLayers().reduce((min, curr) => {
            if (!min) {
                return curr
            }
            return min.getDigitCount(Pixel.BLACK) >
            curr.getDigitCount(Pixel.BLACK)
                ? curr
                : min
        })
        const answer =
            lowest.getDigitCount(Pixel.WHITE) *
            lowest.getDigitCount(Pixel.TRANS)
        console.log('Answer part one: ', answer)
    }

    async partTwo() {
        const out = this.image.decode()
        console.log('Answer part two: ', out)
    }
}
