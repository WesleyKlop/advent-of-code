import Program from '../../Program'
import { readInput } from '../../utils'
import Recipe from './Recipe'
import Chemical from './Chemical'

const recipes: Map<string, Recipe> = readInput('test141.txt')
    .split('\n')
    .map(Recipe.Parse)
    .reduce((map, recipe) => map.set(recipe.output.type, recipe), new Map())

const logRecipe = ({ input, output }: Recipe) => {
    const inputStr = input.map(e => `${e.amount} ${e.type}`).join(',')
    const outputStr = `${output.amount} ${output.type}`
    console.log(`${inputStr} => ${outputStr}`)
}

class NanoFactory {
    readonly inventory: { [type: string]: number } = {}

    private hasChemical(chemical: Chemical): boolean {
        return chemical.type in this.inventory && chemical.amount <= this.inventory[chemical.type]
    }

    private checkInventory(chemicals: Chemical[]): Chemical[] {
        return chemicals.filter(chemical => !this.hasChemical(chemical))
    }

    private takeFromInventory(chemicals: Chemical[]): void {
        chemicals.forEach(chemical => {
            console.log('Taking', chemical)
            this.inventory[chemical.type] -= chemical.amount
        })
    }

    private canCreate(recipe: Recipe): boolean {
        return this.checkInventory(recipe.input).length === 0
    }

    private getRecipeOrAddToInventory(chemical: Chemical): Recipe | undefined {
        const recipe = recipes.get(chemical.type)
        if (!recipe) {
            console.log('Adding', chemical)
            this.addToInventory(chemical)
        }
        return recipe
    }

    public doReaction(chemical: Chemical) {
        const recipe = this.getRecipeOrAddToInventory(chemical)
        if(!recipe) {
            return this
        }
        logRecipe(recipe)
        const missing = this.checkInventory(recipe.input)
        if(missing.length === 0) {
            this.create(recipe)
        }

        missing.forEach(input => {
            this.doReaction(input)
        })

        return this
    }

    private create(recipe: Recipe) {
        this.takeFromInventory(recipe.input)
        this.addToInventory(recipe.output)
    }

    private addToInventory(chemical: Chemical): void {
        if (!(chemical.type in this.inventory)) {
            this.inventory[chemical.type] = 0
        }
        console.log('Adding', chemical)
        this.inventory[chemical.type] += chemical.amount
    }

    private findRecipes(chemicals: Chemical[]): Recipe[] {
        return chemicals
            .reduce((list: Recipe[], chemical: Chemical) => {
                const recipe = recipes.get(chemical.type)
                if (typeof recipe === 'undefined') {
                    // If we don't have a recipe, assume infinite inventory. Add the requirements to the inventory
                    console.log('Adding infinite requirement to inventory', chemical)
                    this.addToInventory(chemical)
                    return list
                }
                list.push(recipe)
                return list
            }, [])
    }

    private doTheThing(chemical: Chemical) {
        const recipe = recipes.get(chemical.type)
        if (typeof recipe === 'undefined') {
            // If we don't have a recipe, assume infinite inventory. Add the requirements to the inventory
            console.log('Adding infinite requirement to inventory', chemical)
            this.addToInventory(chemical)
        }
        return recipe
    }
}

export default class Day14 implements Program<any, any> {
    readonly label: string = 'Day 14'

    async partOne(): Promise<any> {
        const factory = new NanoFactory()
        console.log(factory.doReaction(new Chemical('FUEL', 1)))

        return undefined
    }

    async partTwo(tr1: any): Promise<any> {
        // TODO
    }
}
