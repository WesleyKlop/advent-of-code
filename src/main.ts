const dayToExecute = process.argv.pop()

import(`./${dayToExecute}/${dayToExecute}`).catch(e =>
    console.warn(`Could not find a module for day ${dayToExecute}`),
)
