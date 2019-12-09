export default interface Program {
    readonly label: string
    partOne(): Promise<any>

    partTwo(): Promise<any>
}
