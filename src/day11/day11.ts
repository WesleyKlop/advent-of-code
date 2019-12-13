import { createIntCodeFactory } from '../utils'
import Program from '../Program'
import Computer from '../intcode/Computer'
import IOQueue from '../intcode/IOQueue'
import PaintRobot from './PaintRobot'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day11.txt')

export default class Day11 implements Program {
    public readonly label = 'Day 11'

    async partOne() {
        const program = cloneInstructions()
        const sensor = new IOQueue([0])
        const controls = new IOQueue()
        const computer = new Computer(program, sensor, controls, true)
        const robot = new PaintRobot(computer)
        const [, robotOutput] = await Promise.all([
            computer.executeInstructions(),
            robot.run(),
        ])
        console.log(robotOutput)
        // const layer = new Layer(robotOutput)
        // console.log(layer.toString())
        // console.log('Answer part one: ', robotOutput.map(e => e.length))
    }

    async partTwo() {
        const program = cloneInstructions()
        const output = new IOQueue()
        const computer = new Computer(program, new IOQueue([2]), output)
        await computer.executeInstructions()
        console.log('Answer part two: ', output.getHistory())
    }
}
