set dotenv-required := true

currDay := trim(datetime('%e'))

run file="example.txt" day=currDay:
    @cd 'day{{ day }}'; go run . '{{ file }}'

fetch day=currDay:
    @mkdir -p 'day{{ day }}'
    @curl -o 'day{{ day }}/input.txt' --cookie "$AOC_COOKIE" 'https://adventofcode.com/2024/day/{{ day }}/input'

view day=currDay:
    @open 'https://adventofcode.com/2024/day/{{ day }}'
