# Advent of code

[Advent of code](https://adventofcode.com/2019/)

My solutions to the problems faced during advent of code 2019.

You can build and run the challenges very easily using either docker or npm/yarn.

## Docker
```shell
docker run --rm -v $PWD/inputs:/app/inputs w3ssl3y/aoc             # Runs all days by default (argument = all)
docker run --rm -v $PWD/inputs:/app/inputs w3ssl3y/aoc $arg        # Run a specific day (for example 5)
docker run --rm -v $PWD/inputs:/app/inputs w3ssl3y/aoc --perf $arg # Run with performance metrics, $arg is either all or a day number

docker run --rm -v $PWD/inputs:/app/inputs w3ssl3y/aoc --perf all  # Runs all days with performance metrics
```

## Node  
Use `npm run` instead of `yarn` when that is not available.

```shell
yarn install # Install dependencies
yarn make # Build all files
yarn play <value> # Value can be either "all" or a given day number.
```

## Solutions by friends

Gijs1508: https://github.com/Gijs1508/adventofcode  
Niels: https://gitlab.com/nielsvangijzen/advent-of-code-2019  
Wesley: https://github.com/WesleyKlop/advent-of-code-2019  
Raoul: https://github.com/yoxx/advent-of-code  
Jeanne: https://github.com/jeannegoossens/Advent-Of-Code-2019  
Jelle: https://github.com/jelknab/Advent_of_code_2019  
Gijs dj: https://github.com/gdejong/advent-of-code-2019  
Dion: https://github.com/dionysos1/AdventOfCode2019
Bas: https://github.com/Basje/advent-of-code-2019
