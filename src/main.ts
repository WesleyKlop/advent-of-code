import Program from './Program'
import IOQueue from './day7/IOQueue'
import { Operation } from './day7/Operation'
import { createPerformanceObserver } from './utils'
import { ConsoleExecutor, Executor } from './Executor'

if (process.argv.includes('--perf')) {
    createPerformanceObserver()
}

const loadDay = async (day: number) => {
    const mod = await import(`./day${day}/day${day}`)
    return mod.default as { new (): Program }
}

const playDay = async (arg: string | number) => {
    const dayToExecute = typeof arg === 'string' ? parseInt(arg, 10) : arg
    if (isNaN(dayToExecute)) {
        console.warn(
            'Please enter a day to load or pass all to run all programs',
        )
    }
    try {
        const ProgramImpl = await loadDay(dayToExecute)

        const executor: Executor = new ConsoleExecutor()
        await executor.execute(ProgramImpl)
    } catch (err) {
        console.error('Error in program! Abort...\n', err)
    }
}

const playAllDays = async () => {
    const queue = new IOQueue([1, 2, 3, 4, 5, 6, 7, 8, 9, 99])
    let day = await queue.read()
    do {
        await playDay(day)
        day = await queue.read()
    } while (day !== Operation.HALT)
}

const main = async () => {
    const arg: string = process.argv.pop()!

    switch (arg) {
        case 'all':
            return await playAllDays()
        default:
            return await playDay(arg)
    }
}

main()

export {}
