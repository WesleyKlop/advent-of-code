#!/usr/bin/env node
const fs = require('fs')

// Load and parse the input file
const inputIntList = fs
  .readFileSync(`${__dirname}/input.txt`, 'utf8')
  .trim()
  .split('\n')
  .map(val => val.split(')'))

const traverseMap = (map, child, orbits = 0) => {
  if (!map.has(child)) {
    return orbits
  }
  return traverseMap(map, map.get(child), orbits + 1)
}

const findPath = (map, child, set = []) => {
  set.push(child)
  if (!map.has(child)) {
    return set
  }
  return findPath(map, map.get(child), set)
}

const listToMap = list => {
  const map = new Map()
  list.forEach(([parent, child]) => {
    map.set(child, parent)
  })
  return map
}
// Map of child and its parent
const inputMap = listToMap(inputIntList)

const answerOne = map =>
  inputIntList.reduce((total, [, child]) => {
    return total + traverseMap(map, child)
  }, 0)

const intersect = (a, b) => a.find(loc1 => b.some(loc2 => loc1 === loc2))

const subPath = (path, loc) => {
  return path.slice(1, path.indexOf(loc) + 1)
}

const findOrbitalTransferCost = map => {
  const youPath = findPath(map, 'YOU')
  const sanPath = findPath(map, 'SAN')

  const intersection = intersect(youPath, sanPath)

  return (
    subPath(youPath, intersection).length +
    subPath(sanPath, intersection).length -
    2
  )
}

console.log(answerOne(inputMap))
console.log(findOrbitalTransferCost(inputMap))
