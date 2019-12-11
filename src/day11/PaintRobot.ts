import IOQueue from '../intcode/IOQueue'
import { Pixel } from '../day8/Pixel'
import { Operation } from '../intcode/Operation'

enum Direction {
    UP = 0,
    RIGHT = 1,
    DOWN = 2,
    LEFT = 3,
}

type Position = {
    direction: Direction,
    color: Pixel,
    x: number,
    y: number,
}

export default class PaintRobot {
    private readonly sensor: IOQueue
    private readonly controls: IOQueue
    private isRunning = false
    private readonly path: Position[] = [{
        x: 0,
        y: 0,
        direction: Direction.UP,
        color: Pixel.BLACK,
    }]

    constructor(sensor: IOQueue, controls: IOQueue) {
        this.sensor = sensor
        this.controls = controls
    }

    private getLastPosition(): Position {
        return this.path[this.path.length - 1]
    }

    public async run() {
        while (true) {
            const currentPosition = this.getLastPosition()
            /*
            The IntCode program will serve as the brain of the robot.
            The program uses input instructions to access the robot's camera:
            provide 0 if the robot is over a black panel or 1 if the robot is over a white panel.
            Then, the program will output two values:
                - First, it will output a value indicating the color to paint the
                panel the robot is over: 0 means to paint the panel black, and 1 means to paint the panel white.
                - Second, it will output a value indicating the direction the
                robot should turn: 0 means it should turn left 90 degrees, and 1 means it should turn right 90 degrees.
                After the robot turns, it should always move forward exactly one panel. The robot starts facing up.
             */
            this.sensor.write(currentPosition.color)

            // Get color at current tile
            const color = await this.controls.read() as Pixel | Operation.HALT
            if (color === Operation.HALT) {
                console.log('Received halt')
                break
            }

            const rotation = await this.controls.read()
            console.log('Received rotation', rotation)
            this.execute(color, rotation)
        }
        return this.path
    }

    private execute(color: number, rotation: number) {
        const prevLocation = this.getLastPosition()
        const newDirection = this.calcRotation(prevLocation.direction, rotation)
        const newLocation = this.updateLocation(prevLocation, newDirection)
        const newPosition: Position = {
            color,
            direction: newDirection,
            ...newLocation,
        }
        this.path.push(newPosition)
    }

    private updateLocation({ x, y }: Position, direction: Direction): { x: number, y: number } {
        switch (direction) {
            case Direction.DOWN:
                return { x, y: y - 1 }
            case Direction.LEFT:
                return { x: x - 1, y }
            case Direction.RIGHT:
                return { x: x + 1, y }
            case Direction.UP:
                return { x, y: y + 1 }
            default:
                throw new Error('Invalid direction ' + direction)
        }
    }

    private calcRotation(prevDirection: Direction, delta: number): Direction {
        const direction = prevDirection + (delta === 0 ? -1 : 1)
        if (direction === -1) {
            return Direction.LEFT
        }
        if (direction === 4) {
            return Direction.UP
        }
        return direction
    }
}
