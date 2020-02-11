import IOQueue from '../../intcode/IOQueue'
import { Pixel } from '../day8/Pixel'
import Computer from '../../intcode/Computer'
import { Operation } from '../../intcode/Operation'

type Vec2 = {
    x: number
    y: number
}

enum Direction {
    UP,
    RIGHT,
    DOWN,
    LEFT,
}

enum Turn {
    LEFT,
    RIGHT,
}

export default class PaintRobot {
    private readonly sensor: IOQueue
    private readonly controls: IOQueue

    private readonly map: Pixel[][] = [[Pixel.BLACK]]
    private readonly pos: Vec2 = { x: 0, y: 0 }
    private direction: Direction = Direction.UP

    constructor(computer: Computer) {
        this.sensor = computer.input
        this.controls = computer.output
    }

    public async run() {
        while (true) {
            const { x, y } = this.pos

            // Get color at current tile
            const sensorColor = this.getSensorColor()
            this.sensor.write(sensorColor)
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
            this.map[y][x] = color
            // Should we move left (0) or right (1)
            const rotation = (await this.controls.read()) as Turn

            const force = rotation === Turn.LEFT ? -1 : Turn.RIGHT
            this.direction = (this.direction + force + 4) % 4
            this.updatePosition()
            this.updateMap()
        }
        return this.map
    }

    private getSensorColor() {
        const { y, x } = this.pos
        const color = this.map[y][x]
        if (color === Pixel.TRANS) {
            return Pixel.BLACK
        }
        return color
    }

    private createRow() {
        return new Array(this.map[0].length).fill(Pixel.TRANS)
    }

    private updatePosition() {
        switch (this.direction) {
            case Direction.UP:
                this.pos.y--
                break
            case Direction.DOWN:
                this.pos.y++
                break
            case Direction.LEFT:
                this.pos.x--
                break
            case Direction.RIGHT:
                this.pos.x++
                break
        }
    }

    private updateMap() {
        // When moving up, handle y < 0 by adding a new row to the beginning
        // of the array, basically moving the ground under the robot instead of the robot itself
        if (this.pos.y < 0) {
            this.map.unshift(this.createRow())
            this.pos.y++
        }
        // When moving down, handle y === rowcount by adding a new row to the end
        // of the array, basically moving the ground under the robot instead of the robot itself
        else if (this.pos.y >= this.map.length) {
            this.map.push(this.createRow())
        }
        // When moving left, handle x < 0 by adding a new unpainted pixel to the beginning of each row
        if (this.pos.x < 0) {
            for (let y = 0; y < this.map.length; y++) {
                this.map[y].unshift(Pixel.TRANS)
            }
            this.pos.x++
        }
        // When moving right, handle x >= width by adding a new unpainted pixel to each row
        else if (this.pos.x >= this.map[0].length) {
            for (let y = 0; y < this.map.length; y++) {
                this.map[y].push(Pixel.TRANS)
            }
        }
    }
}
