export default class Chemical {
   public readonly type: string
   public readonly amount: number

    constructor(type: string, amount: number) {
        this.type = type
        this.amount = amount
    }

    static Parse(line: string): Chemical {
        const [amount, type ] = line.split(' ')

        return new Chemical(type, parseInt(amount, 10))
    }
}
