import Program from '../../Program'
import Box from './Box'
import { readInput } from '../../utils'

const input = readInput('2015/day2.txt')
    .split('\n')
    .map((line: string) => line.split('x'))
    .map((items: string[]) => items.map(item => parseInt(item, 10)))
    .map(([length, height, width]: number[]) => new Box(length, width, height))

export default class Day2 implements Program {
    label: string = '2015 / 2'

    async partOne(): Promise<any> {
        const total = input.reduce(
            (acc, curr) => acc + curr.getRequiredWrapping(),
            0,
        )
        console.log(total)
    }

    async partTwo(tr1: any): Promise<any> {
        const total = input.reduce(
            (acc, curr) => acc + curr.getRequiredRibbon(),
            0,
        )
        console.log(total)
    }
}
