import IOQueue from '../../intcode/IOQueue'
import { Operation } from '../../intcode/Operation'

enum Tile {
    EMPTY,
    WALL,
    BLOCK,
    PADDLE,
    BALL,
}

const renderTile = (tile: Tile) => {
    switch (tile) {
        case Tile.BALL:
            return 'O'
        case Tile.BLOCK:
            return '░'
        case Tile.EMPTY:
            return ' '
        case Tile.PADDLE:
            return '_'
        case Tile.WALL:
            return '█'
    }
}

export default class ArcadeCabinet {
    private readonly instructions: IOQueue
    private readonly map: Tile[][] = []

    constructor(instructions: IOQueue) {
        this.instructions = instructions
    }

    public async run() {
        while (true) {
            const x = await this.instructions.read()
            if (x === Operation.HALT) {
                break
            }
            const y = await this.instructions.read()
            const tileId = await this.instructions.read()
            this.draw(x, y, tileId)
            this.drawOnScreen()
            // await sleep(10)
        }

        let blocks = 0
        for (let i = 0; i < this.map.length; i++) {
            for (let j = 0; j < this.map[i].length; j++) {
                if (this.map[i][j] === Tile.BLOCK) {
                    blocks++
                }
            }
        }

        return blocks
    }

    private draw(x: number, y: number, tileId: Tile) {
        if (!this.map[y]) {
            this.map[y] = []
        }
        this.map[y][x] = tileId
    }

    private drawOnScreen() {
        console.clear()
        console.log(
            this.map.map(row => row.map(renderTile).join('')).join('\n'),
        )
    }
}
