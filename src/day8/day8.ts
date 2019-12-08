#!/usr/bin/env node
import fs from 'fs'
import Layer from './Layer'
import Image from './Image'
import { Pixel } from './types'

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`${__dirname}/../../inputs/day8.txt`, 'utf8')
    .trim()
    .split('')
    .map(e => parseInt(e, 10)) as Pixel[]

const LAYER_WIDTH = 25
const LAYER_HEIGHT = 6
const LAYER_SIZE = LAYER_WIDTH * LAYER_HEIGHT

const image = new Image(LAYER_WIDTH, LAYER_HEIGHT)
for (let i = 0; i < inputIntList.length; i += LAYER_SIZE) {
    const slice = inputIntList.slice(i, i + LAYER_SIZE)
    const zeroCount = slice.filter(e => e === 0)

    const layer = Layer.Create(slice, LAYER_HEIGHT, LAYER_WIDTH)
    image.addLayer(layer)
}

const partOne = () => {
    const lowest = image.getLayers().reduce((min, curr) => {
        if (!min) {
            return curr
        }
        return min.getDigitCount(Pixel.BLACK) > curr.getDigitCount(Pixel.BLACK)
            ? curr
            : min
    })
    return lowest.getDigitCount(Pixel.WHITE) * lowest.getDigitCount(Pixel.TRANS)
}

console.log('Part one: ' + partOne())
