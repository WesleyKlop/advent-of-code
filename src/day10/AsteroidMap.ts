export enum Position {
    EMPTY = '.',
    ASTEROID = '#',
}

export type Point = {
    x: number
    y: number
}

export type AsteroidAngles = Map<Number, Asteroid>

export type BestAsteroid = {
    point: Point
    map: AsteroidAngles
}

export class Asteroid {
    public readonly point: Point
    public readonly angle: number
    public readonly distance: number

    constructor(point: Point, angle: number, distance: number) {
        this.point = point
        this.angle = angle
        this.distance = distance
    }
}

export default class AsteroidMap {
    private readonly map: Position[][]

    public constructor(map: Position[][]) {
        this.map = map
    }

    public findBestAsteroid(): BestAsteroid {
        let best: BestAsteroid | undefined
        this.forEachAsteroid(point => {
            const map = this.findVisiblePoints(point)
            if (typeof best === 'undefined' || map.size > best.map.size) {
                best = { map, point }
            }
        })
        return best!
    }

    public forEachAsteroid(func: (point: Point) => void) {
        for (let y = 0; y < this.map.length; y++) {
            const row = this.map[y]
            for (let x = 0; x < row.length; x++) {
                const point: Point = { x, y }
                if (this.isAsteroid(point)) {
                    func(point)
                }
            }
        }
    }

    public findVisiblePoints(origin: Point): Map<number, Asteroid> {
        // Loop through all asteroids, collect visible asteroids in a set<Point>
        const resultMap: Map<number, Asteroid> = new Map()
        this.forEachAsteroid(other => {
            if (other.x === origin.x && other.y === origin.y) {
                return
            }

            const angle = this.calculateAngle(origin, other)
            const distance = this.manhattanDistance(origin, other)
            this.addToMapIfCloser(
                resultMap,
                new Asteroid(other, angle, distance),
            )
        })

        return resultMap
    }

    private addToMapIfCloser(
        resultMap: Map<number, Asteroid>,
        asteroid: Asteroid,
    ) {
        const other = resultMap.get(asteroid.angle)
        if (!other || other.distance > asteroid.distance) {
            resultMap.set(asteroid.angle, asteroid)
        }
    }

    private isAsteroid(point: Point): boolean {
        return this.getPosition(point) === Position.ASTEROID
    }

    private getPosition(p: Point): Position {
        return this.map[p.y][p.x]
    }

    private calculateAngle(origin: Point, other: Point) {
        // Get 2 straight sides
        const sides = this.calculateSides(origin, other)
        // Calculate angle (rad)
        const angle = Math.atan2(sides.y, sides.x)
        // Convert to degrees
        return (angle * 180) / Math.PI
    }

    private calculateSides(origin: Point, other: Point): Point {
        // calc relative distance
        const relX = origin.x - other.x
        const relY = origin.y - other.y

        return { x: relX, y: relY }
    }

    private manhattanDistance(p1: Point, p2: Point): number {
        return Math.abs(p1.x - p2.x) + Math.abs(p1.y - p2.y)
    }
}
