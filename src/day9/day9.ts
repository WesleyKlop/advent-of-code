import { createIntCodeFactory } from '../utils'
import Program from '../Program'
import Computer from '../day7/Computer'
import IOQueue from '../day7/IOQueue'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('test91.txt')

export default class Day9 implements Program {
    async partOne() {
        const program = cloneInstructions()
        const computer = new Computer(program, new IOQueue([1]))
        console.log(await computer.executeInstructions())
    }

    async partTwo() {}
}
