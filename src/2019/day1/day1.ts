import { readInput } from '../../utils'
import Program from '../../Program'

const inputIntList = readInput('day1.txt')
    .split('\n')
    .map(val => parseInt(val))

// Part one
const calcFuel = (mass: number) => Math.floor(mass / 3) - 2

// Part two
const calcFuelSum = (fuelSum: number, fuel: number): number => {
    const extraFuel = calcFuel(fuel)
    if (extraFuel <= 0) {
        return fuelSum
    }
    return calcFuelSum(fuelSum + extraFuel, extraFuel)
}

export default class Day1 implements Program {
    public readonly label: string = 'Day 1'

    async partOne() {
        const answer1 = inputIntList
            .map(calcFuel)
            .reduce((fuelSum, fuel) => fuelSum + fuel, 0)
        console.log('Answer part one: ', answer1)
    }

    async partTwo() {
        const answer2 = inputIntList
            .map(mass => calcFuelSum(0, mass))
            .reduce((totalFuel, fuelSum) => totalFuel + fuelSum, 0)
        console.log('Answer part two: ', answer2)
    }
}
