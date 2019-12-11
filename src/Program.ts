export default interface Program<TR1 = any, TR2 = any> {
    readonly label: string
    partOne(): Promise<TR1>

    partTwo(tr1: TR1): Promise<TR2>
}
