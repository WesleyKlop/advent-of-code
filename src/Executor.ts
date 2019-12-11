import Program from './Program'
import { performance } from 'perf_hooks'

export interface Executor {
    execute(impl: { new(): Program }): Promise<void>
}

export class ConsoleExecutor implements Executor {
    async execute(ProgramImpl: { new(): Program }) {
        performance.mark('start')
        const program = new ProgramImpl()
        console.log(` ----- ${program.label} -----`)
        performance.mark('part-one')
        const partOne = await program.partOne()
        performance.mark('part-two')
        await program.partTwo(partOne)
        performance.mark('finish')

        performance.measure('Init', 'start', 'part-one')
        performance.measure('Part one', 'part-one', 'part-two')
        performance.measure('Part two', 'part-two', 'finish')
        performance.measure('Total time', 'start', 'finish')
    }
}
