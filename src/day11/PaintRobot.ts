import IOQueue from '../intcode/IOQueue'
import { Pixel } from '../day8/Pixel'
import Computer from '../intcode/Computer'
import { Operation } from '../intcode/Operation'

type Vec2 = {
    x: number
    y: number
}

enum Direction {
    UP = 0,
    RIGHT = 1,
    DOWN = 2,
    LEFT = 3,
}

type Position = Vec2 & {
    direction: Direction
    color: Pixel
}

enum Turn {
    LEFT,
    RIGHT,
}

function renderPath(path: Position[]) {
    const map: Pixel[][] = []
    path.forEach(({ x, y, color }) => {
        if (!map[y]) {
            map[y] = []
        }
        map[y][x] = color
    })
    return map
}

function findVisited(path: Position[]) {
    const visited = new Set()
    path.forEach(({ x, y }) => {
        visited.add(`${y},${x}`)
    })
    return visited
}

export default class PaintRobot {
    private readonly sensor: IOQueue
    private readonly controls: IOQueue
    private readonly computer: Computer

    private readonly path: Position[] = [{
        x: 0,
        y: 0,
        direction: Direction.UP,
        color: Pixel.BLACK,
    }]

    constructor(computer: Computer) {
        this.sensor = computer.input
        this.controls = computer.output
        this.computer = computer
    }

    private static applyDirection(direction: Direction): Vec2 {
        switch (direction) {
            case Direction.UP:
                return { x: 0, y: -1 }
            case Direction.DOWN:
                return { x: 0, y: 1 }
            case Direction.LEFT:
                return { x: -1, y: 0 }
            case Direction.RIGHT:
                return { x: 1, y: 0 }
        }
    }

    public async run() {
        while (true) {
            const currentPosition = this.getCurrentPosition()
            // console.log('last', currentPosition)

            // Get color at current tile
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

            // Color to paint the ground(black:0, white:1), or a signal to HALT
            const color = (await this.controls.read()) as Pixel | Operation.HALT
            if (color === Operation.HALT) {
                break
            }
            // Paint the current panel
            currentPosition.color = color
            // Should we move left (0) or right (1)
            const rotation = (await this.controls.read()) as Turn

            const force = rotation === Turn.LEFT ? -1 : Turn.RIGHT
            const direction = (currentPosition.direction + force + 4) % 4
            const newPosition = this.buildNewLocation(direction)
            this.path.push(newPosition)
        }
        return this.path.length
    }

    private getCurrentPosition(): Position {
        return this.path[this.path.length - 1]
    }

    private buildNewLocation(direction: Direction) {
        const delta = PaintRobot.applyDirection(direction)
        const position = this.getCurrentPosition()
        const newPosition: Position = {
            x: position.x + delta.x,
            y: position.y + delta.y,
            color: Pixel.BLACK,
            direction,
        }
        const { color = Pixel.BLACK } = this.findExistingLocation(newPosition)
        return {
            ...newPosition,
            color,
        }
    }

    private findExistingLocation(newPosition: Position): Position {
        const result = this.path.find(({ x, y }) => newPosition.x === x && newPosition.y === y)
        return result || newPosition
    }
}
