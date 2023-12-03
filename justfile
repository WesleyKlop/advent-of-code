today := `date +%-d`
year := `date +%Y`
pkg := "github.com/wesleyklop/advent-of-code"

test case day=today:
    @go run "{{ pkg / "cmd/aoc" }}" -year "{{year}}"  -day "{{day}}" -test "{{case}}"

solve day=today:
    @go run "{{ pkg / "cmd/aoc" }}" -year "{{year}}" -day "{{day}}"

scaffold day=today:
    @mkdir -p "{{ "inputs" / year / day }}"
    @curl --fail --silent --show-error \
      --output "{{ "inputs" / year / day / "input.txt" }}" \
      --cookie  "session=$(cat inputs/session)" \
      'https://adventofcode.com/{{ year }}/day/{{ day }}/input'

build:
    go build -o bin/aoc "{{ pkg / "cmd/aoc" }}"

clean:
    rm -rf bin/

fmt:
    go fmt "{{ pkg / "..." }}"

vet:
    go vet "{{ pkg / "..." }}"

lint: fmt vet