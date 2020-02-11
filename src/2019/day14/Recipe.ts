import Chemical from './Chemical'

export default class Recipe {
    readonly input: Chemical[]
    readonly output: Chemical

    constructor(input: Chemical[], output: Chemical) {
        this.input = input
        this.output = output
    }

    static Parse(line: string): Recipe {
        const [inStr, outputStr] = line.split(' => ')
        const input: Chemical[] = inStr.split(', ').map(Chemical.Parse)

        return new Recipe(input, Chemical.Parse(outputStr))
    }
}
