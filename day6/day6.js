#!/usr/bin/env node
const fs = require('fs')

// Load and parse the input file
const inputIntList = fs
  .readFileSync(`${__dirname}/input.txt`, 'utf8')
  .trim()
  .split('\n')
  .map(val => val.split(')'))

// Map of child and its parent
const map = new Map()

const traverseMap = (map, child, orbits = 0) => {
  if (!map.has(child)) {
    return orbits
  }
  return traverseMap(map, map.get(child), orbits + 1)
}

inputIntList.forEach(([parent, child]) => {
  map.set(child, parent)
})

const answer1 = inputIntList.reduce((total, [, child]) => {
  return total + traverseMap(map, child)
}, 0)

console.log(answer1)
