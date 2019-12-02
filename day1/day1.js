#!/usr/bin/env node
const fs = require('fs')

const inputIntList = fs
  .readFileSync(__dirname + '/input.txt', 'utf8')
  .trim()
  .split('\n')
  .map(e => parseInt(e))

// Part one
const calcFuel = val => Math.floor(val / 3) - 2

const answer1 = inputIntList.map(calcFuel).reduce((acc, curr) => acc + curr, 0)

console.log('Answer 1: ' + answer1)

// Part two
const calcFuelSum = (total, curr) => {
  const add = calcFuel(curr)
  if (add <= 0) {
    return total
  }
  return calcFuelSum(total + add, add)
}

const answer2 = inputIntList
  .map(val => calcFuelSum(0, val))
  .reduce((total, curr) => total + curr, 0)

console.log('Answer 2: ' + answer2)
