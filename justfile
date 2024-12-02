set dotenv-required := true

currDay := trim(datetime('%e'))

test file="example.txt" day=currDay:
    @cd 'day{{ day }}'; go run . '{{ file }}'

answer: (test 'input.txt' currDay)

scaffold day=currDay: (cptpl day) (fetch day) (view day)

fetch day=currDay:
    @mkdir -p 'day{{ day }}'
    @curl -o 'day{{ day }}/input.txt' --cookie "$AOC_COOKIE" 'https://adventofcode.com/2024/day/{{ day }}/input'

view day=currDay:
    @open 'https://adventofcode.com/2024/day/{{ day }}'

cptpl day=currDay:
    @cp -r tpl 'day{{ day }}'

[confirm]
submit answer part='1' day=currDay:
    @curl -X POST 'https://adventofcode.com/2024/day/{{ day }}/answer' \
      --cookie "$AOC_COOKIE" \
      --header 'Accept: text/plain' \
      --data-raw 'level={{ part }}&answer={{ answer }}'