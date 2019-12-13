import { createIntCodeFactory } from '../utils'
import Program from '../Program'
import Computer from '../intcode/Computer'
import IOQueue from '../intcode/IOQueue'
import ArcadeCabinet from './ArcadeCabinet'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day13.txt')

export default class Day13 implements Program {
    public readonly label = 'Day 13'

    async partOne() {
        const program = cloneInstructions()
        const drawer = new IOQueue()
        const computer = new Computer(program, undefined, drawer, true)
        const arcadeCabinet = new ArcadeCabinet(drawer)
        const [, arcadeOutput] = await Promise.all([
            computer.executeInstructions(),
            arcadeCabinet.run(),
        ])
        console.log('Answer part one: ', arcadeOutput)
    }

    async partTwo() {
        const program = cloneInstructions()
        program[0] = 2 // Play for free!
        const drawer = new IOQueue()
        const computer = new Computer(program, undefined, drawer, true)
        const arcadeCabinet = new ArcadeCabinet(drawer)
        const [, arcadeOutput ] = await Promise.all([
            computer.executeInstructions(),
            arcadeCabinet.run(),
        ])
    }
}
