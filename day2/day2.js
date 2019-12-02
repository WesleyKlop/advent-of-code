#!/usr/bin/env node
const fs = require('fs')

// Load and parse the input file
const inputIntList = fs
  .readFileSync(__dirname + '/input.txt', 'utf8')
  .trim()
  .split(',')
  .map(e => parseInt(e))

// Clone the list so you always have a fresh input
const getList = () => [...inputIntList]

const OP_ADD = 1
const OP_TIMES = 2
const OP_EXIT = 99
const LOC_NOUN = 1
const LOC_VERB = 2

// Execute the instructions on a list
const executeList = list => {
  for (let i = 0; i < list.length; i += 4) {
    // Slice the instruction out of the list
    const [opcode, loc1, loc2, reg] = list.slice(i, i + 4)

    switch (opcode) {
      case OP_ADD:
        list[reg] = list[loc1] + list[loc2]
        break
      case OP_TIMES:
        list[reg] = list[loc1] * list[loc2]
        break
      case OP_EXIT:
        return list
      default:
        throw new Error('Invalid opcode ' + opcode)
    }
  }
  throw new Error('No end of program found')
}

// Part one
const list = getList()
list[LOC_NOUN] = 12
list[LOC_VERB] = 2
const [answer1] = executeList(list)
console.log('Answer 1: ' + answer1)

// Part two
const GOAL = 19_690_720
// Loops through all possibilities, noun/verb can be 0-99 incl.
const findOutput = goal => {
  for (let noun = 0; noun <= 99; noun++) {
    for (let verb = 0; verb <= 99; verb++) {
      const list = getList()

      list[LOC_NOUN] = noun
      list[LOC_VERB] = verb

      const [output] = executeList(list)
      if (output === goal) {
        return [noun, verb]
      }
    }
  }
}

const [noun, verb] = findOutput(GOAL)
const answer2 = 100 * noun + verb
console.log('Answer 2: ' + answer2)
