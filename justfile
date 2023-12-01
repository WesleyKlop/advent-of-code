today := `date +%d`

test case day=today :
    go run github.com/wesleyklop/advent-of-code/cmd/aoc -day "{{day}}" -test "{{case}}"

solve day=today:
    go run github.com/wesleyklop/advent-of-code/cmd/aoc -day "{{day}}"

build:
    go build -o bin/aoc github.com/wesleyklop/advent-of-code/cmd/aoc

clean:
    rm -rf bin/