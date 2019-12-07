#!/usr/bin/env node
const fs = require('fs')

const inputIntList = fs
    .readFileSync(`${__dirname}/../../inputs/day1.txt`, 'utf8')
    .trim()
    .split('\n')
    .map(val => parseInt(val))

// Part one
const calcFuel = mass => Math.floor(mass / 3) - 2

const answer1 = inputIntList
    .map(calcFuel)
    .reduce((fuelSum, fuel) => fuelSum + fuel, 0)

console.log('Answer 1: ' + answer1)

// Part two
const calcFuelSum = (fuelSum, fuel) => {
    const extraFuel = calcFuel(fuel)
    if (extraFuel <= 0) {
        return fuelSum
    }
    return calcFuelSum(fuelSum + extraFuel, extraFuel)
}

const answer2 = inputIntList
    .map(mass => calcFuelSum(0, mass))
    .reduce((totalFuel, fuelSum) => totalFuel + fuelSum, 0)

console.log('Answer 2: ' + answer2)
