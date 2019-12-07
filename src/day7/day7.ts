#!/usr/bin/env node
import fs from 'fs'

import { InstructionList } from './types'
import Computer from './Computer'
import IOQueue from './IOQueue'

// Load and parse the input file
const inputIntList: InstructionList = fs
    .readFileSync(`${__dirname}/../inputs/day7.txt`, 'utf8')
    .trim()
    .split(',')
    .map((val: string) => parseInt(val))

// Clone the list so you always have a fresh input
const cloneInstructions = (): InstructionList => [...inputIntList]

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

const partOne = async () => {
    const combinations = permute([0, 1, 2, 3, 4])
    const results = await Promise.all(
        combinations.map(curr => {
            const a = new Computer(
                cloneInstructions(),
                new IOQueue([curr[0], 0]),
                new IOQueue([curr[1]]),
            )
            const b = new Computer(
                cloneInstructions(),
                a.output,
                new IOQueue([curr[2]]),
            )
            const c = new Computer(
                cloneInstructions(),
                b.output,
                new IOQueue([curr[3]]),
            )
            const d = new Computer(
                cloneInstructions(),
                c.output,
                new IOQueue([curr[4]]),
            )
            const e = new Computer(cloneInstructions(), d.output, new IOQueue())
            return Promise.all([
                a.executeInstructions(),
                b.executeInstructions(),
                c.executeInstructions(),
                d.executeInstructions(),
                e.executeInstructions(),
            ]).then(values => {
                console.log(values)
                return Math.max(...values)
            })
        }),
    )
    return results.reduce((max, curr) => Math.max(max, curr), 0)
}

partOne().then(e => {
    console.log('Part one: ' + e)
})
