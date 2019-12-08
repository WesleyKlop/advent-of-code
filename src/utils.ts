import { readFileSync } from 'fs'
import { InstructionList } from './day7/types'

export const readInput = (fileName: string): string =>
    readFileSync(`./inputs/${fileName}`, 'utf8').trim()

export const readIntCode = (fileName: string): InstructionList =>
    readInput(fileName)
        .split(',')
        .map(val => parseInt(val, 10))

export const createIntCodeFactory = (fileName: string) => {
    const program = readIntCode(fileName)
    return (): InstructionList => [...program]
}

export const permute = <T>(input: T[]): T[][] => {
    const permArr: T[][] = []
    const usedChars: T[] = []

    const func = (input: T[]) => {
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
