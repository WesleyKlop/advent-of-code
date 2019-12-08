import Program from '../Program'

const LOWER_BOUND = 382_345
const UPPER_BOUND = 843_167

const digitsAreNotDecreasing = (number: number) => {
    const chars = number
        .toString()
        .split('')
        .map(e => parseInt(e, 10))

    let lowest = chars[0]
    for (let i = 0; i < chars.length; i++) {
        if (lowest > chars[i]) {
            return false
        }
        lowest = chars[i]
    }

    return true
}

const containsDoubleDigit = (number: number): boolean => {
    const matches = number.toString().match(/(\d)\1+/g)
    return matches !== null && matches.some(match => match.length === 2)
}

const isValidNumber = (number: number) => {
    return digitsAreNotDecreasing(number) && containsDoubleDigit(number)
}

const solveForBounds = (lowerBound: number, upperBound: number) => {
    const possibilities = new Set()

    for (let i = lowerBound; i < upperBound; i++) {
        if (isValidNumber(i)) {
            possibilities.add(i)
        }
    }
    return possibilities.size
}

export default class Day4 implements Program {
    async partOne() {
        console.log('Too lazy to implement part one again tbh')
    }
    async partTwo() {
        console.log(solveForBounds(LOWER_BOUND, UPPER_BOUND))
    }
}
