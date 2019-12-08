import * as fs from 'fs'
import { InstructionList } from '../day7/types'
import Computer from '../day7/Computer'
import { Mode } from '../day7/Mode'

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`./inputs/day2.txt`, 'utf8')
    .trim()
    .split(',')
    .map(val => parseInt(val)) as InstructionList

// Clone the list so you always have a fresh input
const cloneInstructions = (): InstructionList => [...inputIntList]

const LOC_NOUN = 1
const LOC_VERB = 2

// Part one
const partOne = async () => {
    const instructions = cloneInstructions()
    instructions[LOC_NOUN] = 12
    instructions[LOC_VERB] = 2
    const computer = new Computer(instructions)

    await computer.executeInstructions()

    const answer1 = computer.read(Mode.POSITION, 0)
    console.log('Answer 1: ' + answer1)
}

partOne()

// Part two
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

const GOAL = 19_690_720

findOutput(GOAL).then(([noun, verb]) => {
    const answer2 = 100 * noun + verb
    console.log('Answer 2: ' + answer2)
})
