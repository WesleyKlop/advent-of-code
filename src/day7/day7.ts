import Computer from './Computer'
import IOQueue from './IOQueue'
import { createIntCodeFactory, permute } from '../utils'
import Program from '../Program'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day7.txt')

export default class Day7 implements Program {
    public readonly label = 'Day 7'

    async partOne() {
        const combinations = permute([0, 1, 2, 3, 4])
        const results = await Promise.all(
            combinations.map(async curr => {
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
                const values = await Promise.all([
                    a.executeInstructions(),
                    b.executeInstructions(),
                    c.executeInstructions(),
                    d.executeInstructions(),
                    e.executeInstructions(),
                ])
                return Math.max(...values)
            }),
        )
        const partOne = results.reduce((max, curr) => Math.max(max, curr), 0)
        console.log('Answer part one: ', partOne)
    }

    async partTwo() {
        const permutations = permute([9, 8, 7, 6, 5])
        const results = await Promise.all(
            permutations.map(async curr => {
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
                const values = await Promise.all([
                    a.executeInstructions(),
                    b.executeInstructions(),
                    c.executeInstructions(),
                    d.executeInstructions(),
                    e.executeInstructions(),
                ])
                return Math.max(...values)
            }),
        )
        const partTwo = results.reduce((max, curr) => Math.max(max, curr), 0)
        console.log('Answer part two: ', partTwo)
    }
}
