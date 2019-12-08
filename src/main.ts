const dayToExecute = process.argv.pop()

import(`./${dayToExecute}/${dayToExecute}`).catch(() =>
    console.warn(`Could not find a module for day ${dayToExecute}`),
)
