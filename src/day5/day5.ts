import * as fs from 'fs'
import { InstructionList } from '../day7/types'
import Computer from '../day7/Computer'
import IOQueue from '../day7/IOQueue'

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`./inputs/day5.txt`, 'utf8')
    .trim()
    .split(',')
    .map(val => parseInt(val)) as InstructionList

// Clone the list so you always have a fresh input
const cloneInstructions = (): InstructionList => [...inputIntList]

const partOne = async () => {
    const computer = new Computer(cloneInstructions(), new IOQueue([1]))
    const answer = await computer.executeInstructions()
    console.log('Part one: ' + answer)
}
partOne()

const partTwo = async () => {
    const computer = new Computer(cloneInstructions(), new IOQueue([5]))
    const answer = await computer.executeInstructions()
    console.log('Part two: ' + answer)
}
partTwo()
