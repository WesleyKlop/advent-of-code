import IOQueue from '../intcode/IOQueue'
import { Pixel } from '../day8/Pixel'
import Computer from '../intcode/Computer'
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
    private readonly path: Position[] = [{
        x: 50,
        y: 50,
        direction: Direction.UP,
        color: Pixel.BLACK,
    }]
    private readonly computer: Computer
    private visitedCount = 0

    constructor(computer: Computer) {
        this.sensor = computer.input
        this.controls = computer.output
        this.computer = computer
    }

    public async run() {
        while (true) {
            const currentPosition = this.getCurrentPosition()
            // console.log('last', currentPosition)
            this.sensor.write(currentPosition.color)
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

            // Get color at current tile
            const color = await this.controls.read() as Pixel | Operation.HALT
            if (color === Operation.HALT) {
                break
            }
            const rotation = await this.controls.read() as 0 | 1

            this.execute(color, rotation)
        }
        return this.visitedCount
    }

    private getCurrentPosition(): Position {
        return this.path[this.path.length - 1]
    }

    private shouldStop() {
        return !this.computer.isRunning()
    }

    private execute(color: number, rotation: number) {
        const prevLocation = this.getCurrentPosition()
        prevLocation.color = color
        console.log('Setting the paint from', prevLocation.color, 'to', color)
        const newDirection = this.calcRotation(prevLocation.direction, rotation)
        const newLocation = this.updateLocation(prevLocation, newDirection)
        const existingLocation = this.findExistingLocation(newLocation)
        if (!existingLocation) {
            this.visitedCount++
        }
        // console.log('existing', existingLocation)
        const newPosition: Position = {
            color: Pixel.BLACK,
            ...existingLocation,
            direction: newDirection,
            ...newLocation,
        }
        this.path.push(newPosition)
    }

    private findExistingLocation({ x, y }: { x: number, y: number }): Position | undefined {
        return this.path.find(e => e.x === x && e.y === y)
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
