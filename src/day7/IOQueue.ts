import { Value, IO } from './types'

export default class IOQueue {
    private history: Value[] = []
    private queue: Value[] = []
    private promise?: Promise<Value>
    private res?: (value: Value) => void

    constructor(initial?: IO) {
        if (initial) {
            this.history = this.history.concat(initial)
            this.queue = this.queue.concat(initial)
        }
        this.createPromise()
    }

    public async read(): Promise<Value> {
        if (this.queue.length > 0) {
            return this.queue.shift()!
        }
        return this.promise!
    }

    private createPromise() {
        this.promise = new Promise(res => (this.res = res))
    }

    private emit() {
        if (this.res) {
            this.res(this.queue.shift()!)
            this.res = undefined
            this.createPromise()
        }
    }

    public write(value: Value) {
        this.history.push(value)
        this.queue.push(value)

        this.emit()
    }

    public merge(values: Value[]) {
        this.queue = this.queue.concat(values)
        this.history = this.history.concat(values)

        this.emit()
    }

    public last(): Value {
        return this.history[this.history.length - 1]
    }
}
