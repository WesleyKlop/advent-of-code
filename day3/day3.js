#!/usr/bin/env node
const fs = require('fs')

const X = 1
const Y = 0

class Action {
  constructor(action) {
    this.action = action[0]
    this.distance = parseInt(action.slice(1))
  }
}

class Locationlist {
  /**
   * @var {Number[][]}
   */
  locations

  constructor() {
    // Every pair is (y, x), origin is bottom left
    this.locations = [[0, 0]]
  }

  cloneLastLocation() {
    return [...this.locations[this.locations.length - 1]]
  }

  addLocation(action) {
    switch (action.action) {
      case 'R':
        for (let i = 1; i <= action.distance; i++) {
          const newLocation = this.cloneLastLocation()
          newLocation[X]++
          this.locations.push(newLocation)
        }
        break
      case 'U':
        for (let i = 1; i <= action.distance; i++) {
          const newLocation = this.cloneLastLocation()
          newLocation[Y]++
          this.locations.push(newLocation)
        }
        break
      case 'L':
        for (let i = 1; i <= action.distance; i++) {
          const newLocation = this.cloneLastLocation()
          newLocation[X]--
          this.locations.push(newLocation)
        }
        break
      case 'D':
        for (let i = 1; i <= action.distance; i++) {
          const newLocation = this.cloneLastLocation()
          newLocation[Y]--
          this.locations.push(newLocation)
        }
        break
    }
  }

  /**
   * @param {Locationlist} other
   */
  intersect(other) {
    let intersections = []
    for (let i = 0; i < this.locations.length; i += 2) {
      const line = this.locations.slice(i, i + 2)
      const lineIntersections = other.locations.filter(location => {
        return this.locationIntersectsWithLine(line, location)
      })
      intersections = intersections.concat(lineIntersections)
    }
    return intersections
  }

  locationIntersectsWithLine([loc1, loc2], [y, x]) {
    return (
      (y >= loc1[Y] && y <= loc2[Y] && x >= loc1[X] && x <= loc2[X]) ||
      (y <= loc1[Y] && y >= loc2[Y] && x <= loc1[X] && x >= loc2[X])
    )
  }
}

// Load and parse the input file
const [path1, path2] = fs
  .readFileSync(`${__dirname}/input.txt`, 'utf8')
  .trim()
  .split('\n')
  .map(path => path.split(',').map(val => new Action(val)))

const executePath = path => {
  const locations = new Locationlist()
  path.forEach(action => {
    locations.addLocation(action)
  })
  locations.locations.shift()
  return locations
}

const manhattanDistance = point => {
  return point.map(Math.abs).reduce((acc, curr) => acc + curr, 0)
}

const closestManhattanDistance = points => {
  return points.map(manhattanDistance).reduce((min, curr) => {
    return curr > min ? min : curr
  }, Number.MAX_VALUE)
}

// Part one
const locations1 = executePath(path1)
const locations2 = executePath(path2)

console.log(closestManhattanDistance(locations1.intersect(locations2)))
