import { IO, Value } from './types'

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
    }

    public async read(): Promise<Value> {
        if (this.queue.length > 0) {
            return this.queue.shift()!
        }
        this.createPromise()
        return this.promise!
    }

    public write(value: Value) {
        this.history.push(value)
        this.queue.push(value)

       if(this.shouldEmit()) {
           this.emit()
       }
    }

    private shouldEmit() {
        return typeof this.promise !== 'undefined'
    }

    public merge(values: Value[]) {
        this.queue = this.queue.concat(values)
        this.history = this.history.concat(values)

        if(this.shouldEmit()) {
            this.emit()
        }
    }

    public last(): Value {
        return this.history[this.history.length - 1]
    }

    public getHistory(): Value[] {
        return this.history
    }

    private createPromise() {
        this.promise = new Promise(res => (this.res = res))
    }

    private emit() {
        this.res!(this.queue.shift()!)
        this.res = undefined
        this.promise = undefined
    }
}
