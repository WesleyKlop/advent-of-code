/**
 * Holds a point on the map, and the # of steps to get there
 */
export default class Point {
    public x: number
    public y: number
    public steps: number

    constructor(x: number, y: number, steps: number) {
        this.x = x
        this.y = y
        this.steps = steps
    }

    /**
     * Clone a Point
     */
    clone(): Point {
        return new Point(this.x, this.y, this.steps)
    }

    /**
     * Calculate the Manhattan distance of a given point
     */
    manhattanDistance(): number {
        return Math.abs(this.x) + Math.abs(this.y)
    }
}
