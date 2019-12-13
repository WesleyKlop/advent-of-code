import { readInput } from '../utils'
import Program from '../Program'

const moons = () =>
    readInput('day12.txt')
        .split('\n')
        .map(val => Moon.create(val))

type Vec3 = {
    x: number
    y: number
    z: number
}

type Axis = 'x' | 'y' | 'z'

class Moon {
    public readonly velocity: Vec3 = { x: 0, y: 0, z: 0 }
    private readonly position: Vec3

    constructor(position: Vec3) {
        this.position = position
    }

    static create(line: string) {
        const matches = line.match(/^<x=(-?\d+), y=(-?\d+), z=(-?\d+)>$/)!
        return new Moon({
            x: parseInt(matches[1], 10),
            y: parseInt(matches[2], 10),
            z: parseInt(matches[3], 10),
        })
    }

    public applyGravity(other: Moon) {
        for (const axis of ['x', 'y', 'z'] as Axis[]) {
            this.updateVelocity(other, axis)
        }
    }

    public applyVelocity() {
        for (const axis of ['x', 'y', 'z'] as Axis[]) {
            this.position[axis] += this.velocity[axis]
        }
    }

    public getTotalEnergy() {
        return this.getKineticEnergy() * this.getPotentialEnergy()
    }

    private updateVelocity(other: Moon, axis: Axis) {
        const force = Math.sign(other.position[axis] - this.position[axis])
        this.velocity[axis] += force
    }

    private getPotentialEnergy() {
        const { x, y, z } = this.position
        return Math.abs(x) + Math.abs(y) + Math.abs(z)
    }

    private getKineticEnergy() {
        const { x, y, z } = this.velocity
        return Math.abs(x) + Math.abs(y) + Math.abs(z)
    }
}

export default class Day12 implements Program<any, any> {
    public readonly label: string = 'Day 12'

    public async partOne(): Promise<any> {
        const moonList = moons()
        for (let step = 0; step < 1000; step++) {
            moonList.forEach(moon => {
                moonList
                    .filter(o => o !== moon)
                    .forEach(other => moon.applyGravity(other))
            })
            moonList.forEach(moon => moon.applyVelocity())
        }
        const totalEnergy = moonList.reduce(
            (energy, moon) => energy + moon.getTotalEnergy(),
            0,
        )
        console.log('Answer part one:', totalEnergy)
    }

    public async partTwo(tr1: any): Promise<any> {
        return undefined
    }
}
