import * as fs from 'fs'

import { InstructionList } from './types'
import Computer from './Computer'
import IOQueue from './IOQueue'

// Load and parse the input file
const inputIntList: InstructionList = fs
    .readFileSync(`./inputs/day7.txt`, 'utf8')
    .trim()
    .split(',')
    .map((val: string) => parseInt(val))

// Clone the list so you always have a fresh input
const cloneInstructions = (): InstructionList => [...inputIntList]

const permute = (input: number[]): number[][] => {
    const permArr: number[][] = []
    const usedChars: number[] = []

    const func = (input: number[]) => {
        var i, ch
        for (i = 0; i < input.length; i++) {
            ch = input.splice(i, 1)[0]
            usedChars.push(ch)
            if (input.length == 0) {
                permArr.push(usedChars.slice())
            }
            func(input)
            input.splice(i, 0, ch)
            usedChars.pop()
        }
        return permArr
    }
    return func(input)
}

const partOne = async () => {
    const combinations = permute([0, 1, 2, 3, 4])
    const results = await Promise.all(
        combinations.map(curr => {
            const a = new Computer(
                cloneInstructions(),
                new IOQueue([curr[0], 0]),
                new IOQueue([curr[1]]),
            )
            const b = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[2]]),
            )
            b.attachInput(a)
            const c = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[3]]),
            )
            c.attachInput(b)
            const d = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[4]]),
            )
            d.attachInput(c)
            const e = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue(),
            )
            e.attachInput(d)
            return Promise.all([
                a.executeInstructions(),
                b.executeInstructions(),
                c.executeInstructions(),
                d.executeInstructions(),
                e.executeInstructions(),
            ]).then(values => {
                return Math.max(...values)
            })
        }),
    )
    return results.reduce((max, curr) => Math.max(max, curr), 0)
}

partOne().then(e => {
    console.log('Part one: ' + e)
})

const partTwo = async () => {
    const permutations = permute([9, 8, 7, 6, 5])
    const results = await Promise.all(
        permutations.map(curr => {
            const a = new Computer(
                cloneInstructions(),
                new IOQueue(),
                new IOQueue([curr[1]]),
            )
            const b = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[2]]),
            )
            b.attachInput(a)
            const c = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[3]]),
            )
            c.attachInput(b)
            const d = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[4]]),
            )
            d.attachInput(c)
            const e = new Computer(
                cloneInstructions(),
                undefined,
                new IOQueue([curr[0], 0]),
            )
            e.attachInput(d)
            a.attachInput(e)
            return Promise.all([
                a.executeInstructions(),
                b.executeInstructions(),
                c.executeInstructions(),
                d.executeInstructions(),
                e.executeInstructions(),
            ]).then(values => Math.max(...values))
        }),
    )
    return results.reduce((max, curr) => Math.max(max, curr), 0)
}

partTwo().then(e => {
    console.log('Part two: ' + e)
})
