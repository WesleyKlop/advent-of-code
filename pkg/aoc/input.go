package aoc

import (
	"fmt"

	"github.com/wesleyklop/advent-of-code/pkg/input"
)

func NewInput(year Year, day Day, fileType FileType) (input.Input, error) {
	path := fmt.Sprintf("./inputs/%d/%d/%s", year, day, fileType.Path())
	return input.NewInput(path)
}
