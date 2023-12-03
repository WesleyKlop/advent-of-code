today := `date +%d`
pkg := "github.com/wesleyklop/advent-of-code"

test case day=today:
    @go run "{{ pkg / "cmd/aoc" }}"  -day "{{day}}" -test "{{case}}"

solve day=today:
    @go run "{{ pkg / "cmd/aoc" }}" -day "{{day}}"

build:
    go build -o bin/aoc "{{ pkg / "cmd/aoc" }}"

clean:
    rm -rf bin/

fmt:
    go fmt "{{ pkg / "..." }}"

vet:
    go vet "{{ pkg / "..." }}"

lint: fmt vet