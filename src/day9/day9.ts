import { createIntCodeFactory } from '../utils'
import Program from '../Program'
import Computer from '../day7/Computer'
import IOQueue from '../day7/IOQueue'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day9.txt')

export default class Day9 implements Program {
    async partOne() {
        const program = cloneInstructions()
        const output = new IOQueue()
        const computer = new Computer(program, new IOQueue([1]), output)
        await computer.executeInstructions()
        console.log(output.getHistory())
    }

    async partTwo() {}
}
