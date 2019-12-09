import Program from './Program'
import IOQueue from './day7/IOQueue'
import { Operation } from './day7/Operation'

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

        console.log(` ----- DAY ${dayToExecute} -----`)
        const program = new ProgramImpl()
        await program.partOne()
        await program.partTwo()
    } catch (err) {
        console.error('Error in program!\n', err)
    }
}

const playAllDays = async () => {
    const queue = new IOQueue([1, 2, 3, 4, 5, 6, 7, 8, 99])
    while (true) {
        const day = await queue.read()
        if (day === Operation.HALT) {
            return
        }
        await playDay(day)
    }
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
