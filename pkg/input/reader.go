package input

import (
	"os"

	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

func (i Input) ReadLines() ([]string, error) {
	contents, err := os.ReadFile(i.path)
	if err != nil {
		return nil, err
	}
	return txt.ReadLines(string(contents)), nil
}

func (i Input) MustReadLines() []string {
	lines, err := i.ReadLines()
	if err != nil {
		panic(err)
	}
	return lines
}
