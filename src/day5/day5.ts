import Computer from '../day7/Computer'
import IOQueue from '../day7/IOQueue'
import { createIntCodeFactory } from '../utils'
import Program from '../Program'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day5.txt')

export default class Day5 implements Program {
    async partOne() {
        const computer = new Computer(cloneInstructions(), new IOQueue([1]))
        const answer = await computer.executeInstructions()
        console.log('Answer part one: ', answer)
    }

    async partTwo() {
        const computer = new Computer(cloneInstructions(), new IOQueue([5]))
        const answer = await computer.executeInstructions()
        console.log('Answer part two: ', answer)
    }
}
