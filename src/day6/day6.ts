import { readInput } from '../utils'
import Program from '../Program'

// Load and parse the input file
const inputIntList = readInput('day6.txt')
    .split('\n')
    .map(val => val.split(')')) as string[][]

// Walk a map and calculate the cost
const traverseMap = (
    map: Map<string, string>,
    child: string,
    orbits: number = 0,
): number => {
    if (!map.has(child)) {
        return orbits
    }
    return traverseMap(map, map.get(child)!, orbits + 1)
}

// Walk a map and find the path it took
const findPath = (
    map: Map<string, string>,
    child: string,
    path: string[] = [],
): string[] => {
    path.push(child)
    if (!map.has(child)) {
        return path
    }
    return findPath(map, map.get(child)!, path)
}

// Convert a list to a map
const listToMap = (list: string[][]): Map<string, string> => {
    const map = new Map()
    list.forEach(([parent, child]) => {
        map.set(child, parent)
    })
    return map
}

// Part one
const findOrbitCountChecksum = (map: Map<string, string>): number =>
    inputIntList.reduce((total, [, child]) => {
        return total + traverseMap(map, child)
    }, 0)

// Find the first place where two lists intersect
const intersect = (a: string[], b: string[]): string =>
    a.find(loc1 => b.some(loc2 => loc1 === loc2))!

// Get the subpath between the first node and a given location
const subPath = (path: string[], loc: string) => {
    return path.slice(1, path.indexOf(loc))
}

// Calculate the amount of orbital transfers between YOU and SANta
const findOrbitalTransferCost = (map: Map<string, string>): number => {
    const youPath = findPath(map, 'YOU')
    const sanPath = findPath(map, 'SAN')

    const intersection = intersect(youPath, sanPath)

    return (
        subPath(youPath, intersection).length +
        subPath(sanPath, intersection).length
    )
}

export default class Day6 implements Program {
    private readonly inputMap: Map<string, string>

    constructor() {
        this.inputMap = listToMap(inputIntList)
    }
    async partOne() {
        console.log(findOrbitCountChecksum(this.inputMap))
    }

    async partTwo() {
        console.log(findOrbitalTransferCost(this.inputMap))
    }
}
