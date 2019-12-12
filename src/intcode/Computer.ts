import { Address, Memory, Modes, RawOpcode, Value } from './types'
import { Mode } from './Mode'
import { Operation } from './Operation'
import { ParsedOpcode } from './ParsedOpcode'
import { Sequence } from './Sequence'
import IOQueue from './IOQueue'

let counter = 0

export default class Computer {
    private static readonly DEBUG = false
    public readonly output: IOQueue
    private readonly label = 'C' + ++counter
    private readonly memory: Memory
    public input: IOQueue
    private jump: number = 4
    private ip: Address = 0
    private relBase: Address = 0
    private running = false
    private emitOnHalt = false

    constructor(memory: Memory, input?: IOQueue, output?: IOQueue, emitOnHalt = false) {
        this.memory = memory
        this.input = input || new IOQueue()
        this.output = output || new IOQueue()
        this.emitOnHalt = emitOnHalt
    }

    public isRunning() {
        return this.running
    }

    public read(mode: Mode = Mode.POSITION, address: Address | Value): Value {
        switch (mode) {
            case Mode.POSITION:
                this.log('Reading', this.memory[address], 'from', address)
                return this.memory[address] || 0
            case Mode.IMMEDIATE:
                return address
            case Mode.RELATIVE:
                return this.memory[this.relBase + address] || 0
            default:
                throw new Error('Invalid parameter mode ' + mode)
        }
    }

    public async executeInstructions(): Promise<Value> {
        this.running = true
        for (this.ip = 0; this.running; this.ip += this.jump) {
            const sequence = this.createSequence()
            this.log(sequence)
            await this.execute(sequence)
        }
        return this.output.last()
    }

    private log(...args: any) {
        if (!Computer.DEBUG || this.label !== 'C1') return
        console.log(this.label, ...args)
    }

    /**
     * Attach a computers output to your input
     * @param other
     */
    public attachInput(other: Computer) {
        this.input = other.output
    }

    private write(
        address: Address,
        value: Value,
        mode: Mode = Mode.IMMEDIATE,
    ): void {
        switch (mode) {
            case Mode.POSITION:
                this.memory[this.memory[address]] = value
                break
            case Mode.IMMEDIATE:
                this.log('Writing', value, 'to', address)
                this.memory[address] = value
                break
            case Mode.RELATIVE:
                this.memory[this.relBase + address] = value
                break
            default:
                throw new Error(
                    'Invalid parameter mode ' + mode + ' ' + typeof mode,
                )
        }
    }

    private parseOpcode(raw: RawOpcode): ParsedOpcode {
        const str = raw.toString()
        // .padStart(4, '0')
        // .padStart(5, '1')
        const opcode = parseInt(str.slice(-2)) as Operation
        const modes = str.slice(0, -2).split('') as Modes

        return {
            modes,
            opcode,
        }
    }

    private createSequence(): Sequence {
        const [rawOpcode, loc1, loc2, reg] = this.memory.slice(
            this.ip,
            this.ip + 4,
        )
        return {
            ...this.parseOpcode(rawOpcode),
            loc1,
            loc2,
            reg,
        }
    }

    /**
     * Execute a given sequence on the computers memory
     * @param sequence the sequence to execute
     */
    private async execute(sequence: Sequence): Promise<Sequence> {
        const { opcode, modes, loc1, loc2, reg } = sequence
        let result
        switch (opcode) {
            case Operation.ADD:
                result =
                    this.read(modes.pop(), loc1) + this.read(modes.pop(), loc2)
                this.write(reg, result, modes.pop())
                this.jump = 4
                break
            case Operation.TIMES:
                result =
                    this.read(modes.pop(), loc1) * this.read(modes.pop(), loc2)
                this.write(reg, result, modes.pop())
                this.jump = 4
                break
            case Operation.INPUT:
                this.log('Input request')
                const input = await this.input.read()
                this.log('Input received:', input)
                this.write(loc1, input, modes.pop())
                this.jump = 2
                break
            case Operation.OUTPUT:
                const value = this.read(modes.pop(), loc1)
                this.log('Output sent:', value)
                this.output.write(value)
                this.jump = 2
                break
            case Operation.JUMP_IF_TRUE:
                this.jump = 3
                if (this.read(modes.pop(), loc1) !== 0) {
                    this.ip = this.read(modes.pop(), loc2)
                    this.jump = 0
                }
                break
            case Operation.JUMP_IF_FALSE:
                this.jump = 3
                if (this.read(modes.pop(), loc1) === 0) {
                    this.ip = this.read(modes.pop(), loc2)
                    this.jump = 0
                }
                break
            case Operation.LOWER_THAN:
                result = Number(
                    this.read(modes.pop(), loc1) < this.read(modes.pop(), loc2),
                )
                this.write(reg, result, modes.pop())
                this.jump = 4
                break
            case Operation.EQUALS:
                result = Number(
                    this.read(modes.pop(), loc1) ===
                    this.read(modes.pop(), loc2),
                )
                this.write(reg, result, modes.pop())
                this.jump = 4
                break
            case Operation.SET_BASE:
                this.relBase += this.read(modes.pop(), loc1)
                this.jump = 2
                break
            case Operation.HALT:
                this.log('HALT')
                if (this.emitOnHalt) {
                    this.output.write(Operation.HALT)
                }
                this.jump = 0
                this.running = false
                break
            default:
                throw new Error('^ Invalid sequence! ^')
        }
        return sequence
    }
}
