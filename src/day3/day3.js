#!/usr/bin/env node
const fs = require('fs')

/**
 * Holds a path action
 */
class Action {
    constructor(action) {
        this.action = action[0]
        this.distance = parseInt(action.slice(1))
    }
}

/**
 * Holds a point on the map, and the # of steps to get there
 */
class Point {
    constructor(x, y, steps) {
        this.x = x
        this.y = y
        this.steps = steps
    }

    /**
     * Clone a Point
     * @returns {Point}
     */
    clone() {
        return new Point(this.x, this.y, this.steps)
    }

    /**
     * Calculate the Manhattan distance of a given point
     * @returns {Number}
     */
    manhattanDistance() {
        return Math.abs(this.x) + Math.abs(this.y)
    }
}

class Locationlist {
    /**
     * @var {Point[]}
     */
    locations

    constructor() {
        // Every pair is (y, x), origin is bottom left
        this.locations = [new Point(0, 0, 0)]
    }

    /**
     * Create a locationlist from a path list
     * @param {Action[]} path
     * @return {Locationlist}
     */
    static Create(path) {
        const locations = new Locationlist()
        path.forEach(action => {
            locations.addLocation(action)
        })
        locations.locations.shift()
        return locations
    }

    /**
     * Clone the last location and increment the steps by one
     * @returns {Point}
     */
    cloneLastAndIncrement() {
        const newLocation = this.locations[this.locations.length - 1].clone()
        newLocation.steps++
        return newLocation
    }

    /**
     * Parse an action and save it to the list
     * @param {Action} action
     */
    addLocation(action) {
        switch (action.action) {
            case 'R':
                for (let i = 1; i <= action.distance; i++) {
                    const newLocation = this.cloneLastAndIncrement()
                    newLocation.x++
                    this.locations.push(newLocation)
                }
                break
            case 'U':
                for (let i = 1; i <= action.distance; i++) {
                    const newLocation = this.cloneLastAndIncrement()
                    newLocation.y++
                    this.locations.push(newLocation)
                }
                break
            case 'L':
                for (let i = 1; i <= action.distance; i++) {
                    const newLocation = this.cloneLastAndIncrement()
                    newLocation.x--
                    this.locations.push(newLocation)
                }
                break
            case 'D':
                for (let i = 1; i <= action.distance; i++) {
                    const newLocation = this.cloneLastAndIncrement()
                    newLocation.y--
                    this.locations.push(newLocation)
                }
                break
        }
    }

    /**
     * Intersect the locations of two location lists
     * @param {Locationlist} other
     * @return {Locationlist} new locationlist
     */
    intersect(other) {
        const list = new Locationlist()
        list.locations = this.locations.filter(point1 => {
            return other.locations.some(point2 => {
                return point1.x === point2.x && point1.y === point2.y
            })
        })
        return list
    }

    /**
     * Find the cheapest intersection by steps
     * @param {Locationlist} other
     * @returns {Number}
     */
    findFirstIntersection(other) {
        return this.locations
            .map(point1 => {
                const intersection = other.locations.find(point2 => {
                    return point1.x === point2.x && point1.y === point2.y
                })
                if (intersection) {
                    return intersection.steps + point1.steps
                }
            })
            .filter(e => typeof e !== 'undefined')
            .reduce((min, curr) => {
                return Math.min(min, curr)
            }, Number.MAX_VALUE)
    }

    /**
     * Calculate the closest manhattan distance of the location list
     * @returns {Number}
     */
    closestManhattanDistance() {
        return this.locations
            .map(p => p.manhattanDistance())
            .reduce((min, curr) => {
                return curr > min ? min : curr
            }, Number.MAX_VALUE)
    }
}

// Load and parse the input file
const [path1, path2] = fs
    .readFileSync(`${__dirname}/../../inputs/day3.txt`, 'utf8')
    .trim()
    .split('\n')
    .map(path => path.split(',').map(val => new Action(val)))

const locations1 = Locationlist.Create(path1)
const locations2 = Locationlist.Create(path2)

const intersections = locations1.intersect(locations2)
console.log('Answer part one: ' + intersections.closestManhattanDistance())
console.log('Answer part two: ' + locations1.findFirstIntersection(locations2))
