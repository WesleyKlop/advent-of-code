import { ParsedOpcode } from './ParsedOpcode'
import { Address, Value } from './types'

export interface Sequence extends ParsedOpcode {
  loc1: Address | Value
  loc2: Address | Value
  reg: Address
}
