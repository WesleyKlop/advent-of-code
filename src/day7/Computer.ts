import { IO, InstructionList, Address, Value, RawOpcode, Modes } from './types'
import { Mode } from './Mode'
import { Operation } from './Operation'
import { ParsedOpcode } from './ParsedOpcode'
import { Sequence } from './Sequence'
import IOQueue from './IOQueue'

export default class Computer {
    private input: IOQueue
    private output: IOQueue
    private instructions: InstructionList
    private jump: number = 4
    private ip: Address = 0
    private running = false

    constructor(
        instructions: InstructionList,
        input?: IOQueue,
        output?: IOQueue,
    ) {
        this.instructions = instructions
        this.input = input || new IOQueue()
        this.output = output || new IOQueue()
    }

    private read(mode: Mode, address: Address | Value): Value {
        switch (mode) {
            case Mode.POSITION:
                return this.instructions[address]
            case Mode.IMMEDIATE:
                return address
            default:
                throw new Error('Invalid parameter mode ' + mode)
        }
    }

    private write(address: Address, value: Value): void {
        this.instructions[address] = value
    }

    private parseOpcode(raw: RawOpcode): ParsedOpcode {
        const str = raw.toString().padStart(5, '0')
        const opcode = parseInt(str.slice(-2)) as Operation
        const modes = str.slice(0, -2).split('') as Modes

        return {
            modes,
            opcode,
        }
    }

    private createSequence(): Sequence {
        const [rawOpcode, loc1, loc2, reg] = this.instructions.slice(
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

    public async executeInstructions(): Promise<Value> {
        this.running = true
        for (this.ip = 0; this.running; this.ip += this.jump) {
            const sequence = this.createSequence()
            await this.execute(sequence)
        }
        return this.output.last()
    }

    /**
     * Execute a given sequence on the computers memory
     * @param sequence the sequence to execute
     */
    private async execute(sequence: Sequence): Promise<Sequence> {
        const { opcode, modes, loc1, loc2, reg } = sequence

        switch (opcode) {
            case Operation.ADD:
                this.write(
                    reg,
                    this.read(modes.pop()!, loc1) +
                        this.read(modes.pop()!, loc2),
                )
                this.jump = 4
                break
            case Operation.TIMES:
                this.write(
                    reg,
                    this.read(modes.pop()!, loc1) *
                        this.read(modes.pop()!, loc2),
                )
                this.jump = 4
                break
            case Operation.INPUT:
                const input = await this.input.read()
                this.write(loc1, input)
                this.jump = 2
                break
            case Operation.OUTPUT:
                this.output.write(this.instructions[loc1])
                this.jump = 2
                break
            case Operation.JUMP_IF_TRUE:
                this.jump = 3
                if (this.read(modes.pop()!, loc1) !== 0) {
                    this.ip = this.read(modes.pop()!, loc2)
                    this.jump = 0
                }
                break
            case Operation.JUMP_IF_FALSE:
                this.jump = 3
                if (this.read(modes.pop()!, loc1) === 0) {
                    this.ip = this.read(modes.pop()!, loc2)
                    this.jump = 0
                }
                break
            case Operation.LOWER_THAN:
                this.write(
                    reg,
                    Number(
                        this.read(modes.pop()!, loc1) <
                            this.read(modes.pop()!, loc2),
                    ),
                )
                this.jump = 4
                break
            case Operation.EQUALS:
                this.write(
                    reg,
                    Number(
                        this.read(modes.pop()!, loc1) ===
                            this.read(modes.pop()!, loc2),
                    ),
                )
                this.jump = 4
                break
            case Operation.HALT:
                this.jump = 0
                this.running = false
                break
            default:
                throw new Error('Invalid sequence: ' + JSON.stringify(sequence))
        }
        return sequence
    }

    /**
     * Attach a computers output to your input
     * @param other
     */
    public attachInput(other: Computer) {
        this.input = other.output
    }

    /**
     * Attach a computers input to your output
     * @param other the other computer
     */
    public attachOutput(other: Computer) {
        this.output = other.input
    }

    /**
     * Push values into the computers input
     * @param values
     */
    public push(values: Value[]) {
        this.input.merge(values)
    }
}
