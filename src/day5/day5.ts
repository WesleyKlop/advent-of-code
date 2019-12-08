import * as fs from 'fs'

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`./inputs/day5.txt`, 'utf8')
    .trim()
    .split(',')
    .map(val => parseInt(val))

// Clone the list so you always have a fresh input
const cloneInstructions = () => [...inputIntList]

// Operation types
const OP_ADD = 1
const OP_TIMES = 2
const OP_INPUT = 3
const OP_OUTPUT = 4
const OP_JIT = 5
const OP_JIF = 6
const OP_LT = 7
const OP_EQ = 8
const OP_EXIT = 99
// Parameter types
const PARAM_MODE_POSITION = '0'
const PARAM_MODE_IMMEDIATE = '1'

// Read a parameter in a given mode
const readParameter = (list, mode = PARAM_MODE_POSITION, address) => {
    switch (mode) {
        case PARAM_MODE_POSITION:
            return list[address]
        case PARAM_MODE_IMMEDIATE:
            return address
        default:
            throw new Error('Invalid parameter mode ' + mode)
    }
}

// Parse a raw opcode to extract the parameter modes
const parseOpcode = raw => {
    const opcode = raw.toString().slice(-2)
    const mode = raw
        .toString()
        .slice(0, -2)
        .split('')

    return [mode, parseInt(opcode, 10)]
}

// Execute the instructions on a list
const executeInstructions = (instructions, input) => {
    let jump = 4
    for (let i = 0; i < instructions.length; i += jump) {
        // Slice the instruction out of the list
        const [rawOpcode, loc1, loc2, reg] = instructions.slice(i, i + 4)
        const [modes, opcode] = parseOpcode(rawOpcode)

        switch (opcode) {
            case OP_ADD:
                instructions[reg] =
                    readParameter(instructions, modes.pop(), loc1) +
                    readParameter(instructions, modes.pop(), loc2)
                jump = 4
                break
            case OP_TIMES:
                instructions[reg] =
                    readParameter(instructions, modes.pop(), loc1) *
                    readParameter(instructions, modes.pop(), loc2)
                jump = 4
                break
            case OP_INPUT:
                instructions[loc1] = input.pop()
                jump = 2
                break
            case OP_OUTPUT:
                console.log(`[OUTPUT] ${instructions[loc1]}`)
                jump = 2
                break
            case OP_JIT:
                jump = 3
                if (readParameter(instructions, modes.pop(), loc1) !== 0) {
                    i = readParameter(instructions, modes.pop(), loc2)
                    jump = 0
                }
                break
            case OP_JIF:
                jump = 3
                if (readParameter(instructions, modes.pop(), loc1) === 0) {
                    i = readParameter(instructions, modes.pop(), loc2)
                    jump = 0
                }
                break
            case OP_LT:
                instructions[reg] = Number(
                    readParameter(instructions, modes.pop(), loc1) <
                        readParameter(instructions, modes.pop(), loc2),
                )
                jump = 4
                break
            case OP_EQ:
                instructions[reg] = Number(
                    readParameter(instructions, modes.pop(), loc1) ===
                        readParameter(instructions, modes.pop(), loc2),
                )
                jump = 4
                break
            case OP_EXIT:
                jump = 0
                return instructions
            default:
                throw new Error('Invalid opcode ' + opcode)
        }
    }
    throw new Error('No end of program found')
}

executeInstructions(cloneInstructions(), [1])
console.log('Answer 1 ^^^^^^^')
executeInstructions(cloneInstructions(), [5])
console.log('Answer 2 ^^^^^^^')
