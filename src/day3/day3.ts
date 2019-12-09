import { readInput } from '../utils'
import Action from './Action'
import Locationlist from './Locationlist'
import Program from '../Program'

// Load and parse the input file
const [path1, path2] = readInput('day3.txt')
    .split('\n')
    .map(path => path.split(',').map(val => new Action(val)))

export default class Day3 implements Program {
    public readonly label = 'Day 3'

    private locations1: Locationlist
    private locations2: Locationlist

    constructor() {
        this.locations1 = Locationlist.Create(path1)
        this.locations2 = Locationlist.Create(path2)
    }

    async partOne() {
        const intersections = this.locations1.intersect(this.locations2)
        console.log(
            'Answer part one: ',
            intersections.closestManhattanDistance(),
        )
    }

    async partTwo() {
        console.log(
            'Answer part two: ',
            this.locations1.findFirstIntersection(this.locations2),
        )
    }
}
