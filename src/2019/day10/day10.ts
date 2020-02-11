import Program from '../../Program'
import { readInput } from '../../utils'
import AsteroidMap, { BestAsteroid, Position } from './AsteroidMap'

const strToMap = (str: string): Position[][] =>
    str.split('\n').map(e => e.trim().split('')) as Position[][]

const parseInput = (file = 'day10.txt'): Position[][] =>
    strToMap(readInput(file))

export default class Day10 implements Program<BestAsteroid> {
    label: string = 'Day 10'
    map: AsteroidMap

    constructor() {
        this.map = new AsteroidMap(parseInput())
    }

    public async partOne(): Promise<any> {
        const bestAsteroid = this.map.findBestAsteroid()
        console.log('Answer part one:', bestAsteroid.map.size)
        return bestAsteroid
    }

    public async partTwo({ point: origin }: BestAsteroid): Promise<any> {
        const { point } = this.map.imaFirinMahLazor(origin)
        console.log('Answer part two:', point.x * 100 + point.y)
    }
}
