#!/usr/bin/env node
const fs = require('fs')

const input = fs.readFileSync(__dirname + '/input.txt', 'utf8')

const inputIntList = input.trim().split(',').map(e => parseInt(e))

const execute = (list, opcode, loc1, loc2) => {
    switch (opcode) {
        case 1:
            return list[loc1] + list[loc2]
        case 2:
            return list[loc1] * list[loc2]
        case 99:
            console.log('Should stop now')
            return list[0]
        default:
            throw new Error('Invalid opcode ' + opcode)
    }
}

const executeList = list => {
    for (let i = 0; i < list.length; i += 4) {
        const [opcode, loc1, loc2, reg] = list.slice(i, i + 4)
        list[reg] = execute(list, opcode, loc1, loc2)
        if(opcode === 99) {
            return list
        }
    }
    throw new Error('No end of program found')
}

// console.log(executeList([1, 0, 0, 0, 99]))
console.log(executeList([2,4,4,5,99,0]))
console.log()
inputIntList[1] = 12
inputIntList[2] = 2
console.log('Answer 1: ' + executeList(inputIntList)[0])