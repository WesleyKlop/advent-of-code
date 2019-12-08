const dayToExecute = process.argv.pop()

const main = async () => {
    try {
        await import(`./day${dayToExecute}/day${dayToExecute}`)
    } catch {
        console.warn('Could not find module..')
    }
}

main()

export {}
