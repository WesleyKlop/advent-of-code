import { readFileSync } from 'fs'
import { Memory } from './intcode/types'
import { PerformanceObserver } from 'perf_hooks'

export const createPerformanceObserver = () => {
    const obs = new PerformanceObserver(items => {
        items.getEntries().forEach(item => {
            console.log(`${item.name}:`, item.duration)
        })
    })
    obs.observe({ entryTypes: ['measure'] })
}

export const readInput = (fileName: string): string =>
    readFileSync(`./inputs/${fileName}`, 'utf8').trim()

export const readIntCode = (fileName: string): Memory =>
    readInput(fileName)
        .split(',')
        .map(val => parseInt(val, 10))

export const createIntCodeFactory = (fileName: string) => {
    const program = readIntCode(fileName)
    return (): Memory => [...program]
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
