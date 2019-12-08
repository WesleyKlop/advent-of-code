/**
 * Holds a path action
 */
export default class Action {
    public readonly action: string
    public readonly distance: number
    constructor(action: string) {
        this.action = action[0]
        this.distance = parseInt(action.slice(1))
    }
}
