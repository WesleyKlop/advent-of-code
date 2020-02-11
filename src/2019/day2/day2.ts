import Computer from '../../intcode/Computer'
import { Mode } from '../../intcode/Mode'
import { createIntCodeFactory } from '../../utils'
import Program from '../../Program'

// Clone the list so you always have a fresh input
const cloneInstructions = createIntCodeFactory('day2.txt')

const LOC_NOUN = 1
const LOC_VERB = 2

// Loops through all possibilities, noun/verb can be 0-99 incl.
const findOutput = async (goal: number): Promise<number[]> => {
    for (let noun = 0; noun <= 99; noun++) {
        for (let verb = 0; verb <= 99; verb++) {
            const instructions = cloneInstructions()

            instructions[LOC_NOUN] = noun
            instructions[LOC_VERB] = verb

            const computer = new Computer(instructions)

            await computer.executeInstructions()
            const output = computer.read(Mode.POSITION, 0)
            if (output === goal) {
                return [noun, verb]
            }
        }
    }
    throw new Error('Couldnt find output')
}

export default class Day2 implements Program {
    public readonly label = 'Day 2'

    async partOne() {
        const instructions = cloneInstructions()
        instructions[LOC_NOUN] = 12
        instructions[LOC_VERB] = 2
        const computer = new Computer(instructions)

        await computer.executeInstructions()

        const answer1 = computer.read(Mode.POSITION, 0)
        console.log('Answer part one: ', answer1)
    }

    async partTwo() {
        const GOAL = 19_690_720

        const [noun, verb] = await findOutput(GOAL)
        const answer2 = 100 * noun + verb
        console.log('Answer part two: ', answer2)
    }
}
