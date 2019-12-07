#!/usr/bin/env node
const fs = require('fs')

// Load and parse the input file
const inputIntList = fs
    .readFileSync(`${__dirname}/../../inputs/day6.txt`, 'utf8')
    .trim()
    .split('\n')
    .map(val => val.split(')'))

// Walk a map and calculate the cost
const traverseMap = (map, child, orbits = 0) => {
    if (!map.has(child)) {
        return orbits
    }
    return traverseMap(map, map.get(child), orbits + 1)
}

// Walk a map and find the path it took
const findPath = (map, child, path = []) => {
    path.push(child)
    if (!map.has(child)) {
        return path
    }
    return findPath(map, map.get(child), path)
}

// Convert a list to a map
const listToMap = list => {
    const map = new Map()
    list.forEach(([parent, child]) => {
        map.set(child, parent)
    })
    return map
}

// Map of child -> parent
const inputMap = listToMap(inputIntList)

// Part one
const findOrbitCountChecksum = map =>
    inputIntList.reduce((total, [, child]) => {
        return total + traverseMap(map, child)
    }, 0)

// Find the first place where two lists intersect
const intersect = (a, b) => a.find(loc1 => b.some(loc2 => loc1 === loc2))

// Get the subpath between the first node and a given location
const subPath = (path, loc) => {
    return path.slice(1, path.indexOf(loc))
}

// Calculate the amount of orbital transfers between YOU and SANta
const findOrbitalTransferCost = map => {
    const youPath = findPath(map, 'YOU')
    const sanPath = findPath(map, 'SAN')

    const intersection = intersect(youPath, sanPath)

    return (
        subPath(youPath, intersection).length +
        subPath(sanPath, intersection).length
    )
}

console.log(findOrbitCountChecksum(inputMap))
console.log(findOrbitalTransferCost(inputMap))
