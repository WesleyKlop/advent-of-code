import { Value, IO } from './types'

export default class IOQueue {
    private history: Value[] = []
    private queue: Value[] = []
    private promise?: (value: Value) => void

    constructor(initial?: IO) {
        if (initial) {
            this.history = this.history.concat(initial)
            this.queue = this.queue.concat(initial)
        }
    }

    public read(): Promise<Value> {
        return new Promise(res => {
            if (this.queue.length > 0) {
                this.emit()
            } else {
                this.promise = res
            }
        })
    }

    private emit() {
        if (typeof this.promise === 'undefined') {
            return
        }
        this.promise!(this.queue.shift()!)
        delete this.promise
    }

    public write(value: Value) {
        this.history.push(value)
        this.queue.push(value)
        this.emit()
    }

    public merge(values: Value[]) {
        this.queue = values
        this.emit()
    }

    public last(): Value {
        return this.history[this.history.length - 1]
    }
}
