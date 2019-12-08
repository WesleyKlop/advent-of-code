import fs from 'fs'

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`./inputs/day2.txt`, 'utf8')
    .trim()
    .split(',')
    .map(val => parseInt(val))

// Clone the list so you always have a fresh input
const cloneInstructions = () => [...inputIntList]

const OP_ADD = 1
const OP_TIMES = 2
const OP_EXIT = 99
const LOC_NOUN = 1
const LOC_VERB = 2

// Execute the instructions on a list
const executeInstructions = instructions => {
    for (let i = 0; i < instructions.length; i += 4) {
        // Slice the instruction out of the list
        const [opcode, loc1, loc2, reg] = instructions.slice(i, i + 4)

        switch (opcode) {
            case OP_ADD:
                instructions[reg] = instructions[loc1] + instructions[loc2]
                break
            case OP_TIMES:
                instructions[reg] = instructions[loc1] * instructions[loc2]
                break
            case OP_EXIT:
                return instructions
            default:
                throw new Error('Invalid opcode ' + opcode)
        }
    }
    throw new Error('No end of program found')
}

// Part one
const instructions = cloneInstructions()
instructions[LOC_NOUN] = 12
instructions[LOC_VERB] = 2
const [answer1] = executeInstructions(instructions)
console.log('Answer 1: ' + answer1)

// Part two
const GOAL = 19_690_720
// Loops through all possibilities, noun/verb can be 0-99 incl.
const findOutput = goal => {
    for (let noun = 0; noun <= 99; noun++) {
        for (let verb = 0; verb <= 99; verb++) {
            const instructions = cloneInstructions()

            instructions[LOC_NOUN] = noun
            instructions[LOC_VERB] = verb

            const [output] = executeInstructions(instructions)
            if (output === goal) {
                return [noun, verb]
            }
        }
    }
}

const [noun, verb] = findOutput(GOAL)
const answer2 = 100 * noun + verb
console.log('Answer 2: ' + answer2)
