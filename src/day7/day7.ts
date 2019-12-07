#!/usr/bin/env node
import fs from 'fs'

type Address = number
type InstructionList = number[]
type RawOpcode = number
type Modes = Array<Mode>
type IO = number[]

// Load and parse the input file
const inputIntList: InstructionList = fs
  .readFileSync(`${__dirname}/input.txt`, 'utf8')
  .trim()
  .split(',')
  .map((val: string) => parseInt(val))

// Clone the list so you always have a fresh input
const cloneInstructions = (): InstructionList => [...inputIntList]

// Operation types
enum Operation {
  ADD = 1,
  TIMES = 2,
  INPUT = 3,
  OUTPUT = 4,
  JUMP_IF_TRUE = 5,
  JUMP_IF_FALSE = 6,
  LOWER_THAN = 7,
  EQUALS = 8,
  HALT = 99,
}
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
enum Mode {
  POSITION = '0',
  IMMEDIATE = '1',
}

// Read a parameter in a given mode
const readParameter = (
  list: InstructionList,
  mode: Mode = Mode.POSITION,
  address: Address,
): number => {
  switch (mode) {
    case Mode.POSITION:
      return list[address]
    case Mode.IMMEDIATE:
      return address
    default:
      throw new Error('Invalid parameter mode ' + mode)
  }
}

// Parse a raw opcode to extract the parameter modes
const parseOpcode = (raw: RawOpcode) => {
  const opcode = raw.toString().slice(-2)
  const mode = raw
    .toString()
    .padStart(5, '0')
    .slice(0, -2)
    .split('') as Modes

  return [mode, parseInt(opcode, 10) as Operation]
}

// Execute the instructions on a list
const executeInstructions = (
  instructions: InstructionList,
  input: IO,
  output: IO,
) => {
  let jump = 4
  for (let i = 0; i < instructions.length; i += jump) {
    // Slice the instruction out of the list
    const [rawOpcode, loc1, loc2, reg] = instructions.slice(i, i + 4)
    const parsedOpcode = parseOpcode(rawOpcode)
    const modes = parsedOpcode[0] as Modes
    const opcode = parsedOpcode[1] as Operation

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
        instructions[loc1] = input.shift()!
        // console.log(`[ INPUT] ${instructions[loc1]}`)
        jump = 2
        break
      case OP_OUTPUT:
        console.log(`[OUTPUT] ${instructions[loc1]}`)
        output.push(instructions[loc1])
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

const permute = (input: number[]): number[][] => {
  const permArr: number[][] = []
  const usedChars: number[] = []

  const func = (input: number[]) => {
    var i, ch
    for (i = 0; i < input.length; i++) {
      ch = input.splice(i, 1)[0]
      usedChars.push(ch)
      if (input.length == 0) {
        permArr.push(usedChars.slice())
      }
      func(input)
      input.splice(i, 0, ch)
      usedChars.pop()
    }
    return permArr
  }
  return func(input)
}

const partOne = () => {
  const combinations = permute([0, 1, 2, 3, 4])

  const maximum = combinations.reduce((max, curr) => {
    const output = [0]
    curr.forEach(ps => {
      const input = [ps, output.pop()] as IO
      executeInstructions(cloneInstructions(), input, output)
    })
    return Math.max(max, output[0])
  }, 0)
  return maximum
}

console.log('Part one: ' + partOne())
