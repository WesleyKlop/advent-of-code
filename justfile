set dotenv-required := true

currYear := '2025'
currDay := trim(datetime('%e'))

test  day=currDay file="example.txt":
    @cd 'day{{ day }}'; go run . '{{ file }}'

solve day=currDay: (test day 'input.txt')
answer: (test  currDay 'input.txt')

scaffold day=currDay: (cptpl day) (fetch day) (view day)

fetch day=currDay:
    @mkdir -p 'day{{ day }}'
    @curl -o 'day{{ day }}/input.txt' --cookie "$AOC_COOKIE" 'https://adventofcode.com/{{ currYear }}/day/{{ day }}/input'

view day=currDay:
    @open 'https://adventofcode.com/{{ currYear }}/day/{{ day }}'

cptpl day=currDay:
    @cp -r tpl 'day{{ day }}'

[confirm]
submit answer part='1' day=currDay:
    @curl -X POST 'https://adventofcode.com/{{ currYear }}/day/{{ day }}/answer' \
      --cookie "$AOC_COOKIE" \
      --header 'Accept: text/plain' \
      --data-raw 'level={{ part }}&answer={{ answer }}'