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
