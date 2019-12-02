#!/usr/bin/env node
const fs = require('fs')

const input = fs.readFileSync(__dirname + '/input.txt', 'utf8')

const inputIntList = input.trim().split('\n').map(e => parseInt(e))

const partOne = inputIntList.map(e => Math.floor(e / 3) - 2).reduce((acc, curr) => acc + curr, 0)

console.log('Part one answer: ' + partOne)


const calcFuel = val => Math.floor(val / 3) - 2

const calcFuelSum = (total, curr) => {
    const add = calcFuel(curr)
    if(add <= 0) {
        return total
    }
    return calcFuelSum(total + add, add)
}

console.log('out ' + calcFuelSum(0, 100756))

const partTwo = inputIntList.map(e => calcFuelSum(0, e)).reduce((total, curr) => total + curr, 0)
console.log('Part two answer: ' + partTwo)