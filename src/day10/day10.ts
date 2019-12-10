import Program from '../Program'
import { readInput } from '../utils'
import AsteroidMap, { Position, Point, Asteroid } from './AsteroidMap'

const strToMap = (str: string): Position[][] =>
    str.split('\n').map(e => e.trim().split('')) as Position[][]

const parseInput = (file = 'day10.txt'): Position[][] =>
    strToMap(readInput(file))

export default class Day10 implements Program {
    label: string = 'Day 10'
    map: AsteroidMap

    constructor() {
        this.map = new AsteroidMap(parseInput())
    }

    public async partOne(): Promise<any> {
        console.log('Answer part one:', this.map.findBestAsteroid().size)
    }

    public async partTwo(): Promise<any> {
        throw new Error('Method not implemented.')
    }
}
