import { IO, Value } from './types'

type RequestQueue = ((val: Value) => void)[]
let counter = 0
export default class IOQueue {
    private static readonly DEBUG = false
    private readonly label = 'Q' + ++counter
    private readonly history: IO = []
    private readonly requests: RequestQueue = []
    private readonly backlog: IO = []

    constructor(initial?: IO) {
        this.backlog = initial || this.backlog
    }

    public async read(): Promise<Value> {
        return this.createRequest()
    }

    public write(value: Value) {
        this.backlog.push(value)
        this.history.push(value)
        this.cycle()
    }

    public last(): Value {
        const lastHistoryEntry = this.history[this.history.length - 1]
        const lastBacklogEntry = this.backlog[this.backlog.length - 1]
        return lastHistoryEntry || lastBacklogEntry
    }

    private hasWork(): boolean {
        return this.requests.length > 0 && this.backlog.length > 0
    }

    private log(...args: any) {
        if (!IOQueue.DEBUG) {
            return
        }
        console.log(this.label, args)
    }

    private cycle() {
        this.log('Requests:', this.requests.length, 'Backlog:', this.backlog.length)
        if (this.hasWork()) {
            const value = this.backlog.shift()!
            const listener = this.requests.shift()!
            listener(value)
        }
    }

    private createRequest(): Promise<Value> {
        return new Promise(res => {
            this.requests.push(res)
            this.cycle()
        })
    }

    public getHistory(): Value[] {
        return this.history
    }
}
