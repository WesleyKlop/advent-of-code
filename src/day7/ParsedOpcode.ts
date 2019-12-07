import { Operation } from './Operation'
import { Modes } from './types'

export interface ParsedOpcode {
    modes: Modes
    opcode: Operation
}
