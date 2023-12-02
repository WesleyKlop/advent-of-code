package aoc

import "fmt"

type FileType string

const (
	PuzzleInput FileType = "input"
)

func TestInput(nr int) FileType {
	return FileType(fmt.Sprintf("test_%d", nr))
}

func (ft FileType) Path() string {
	return fmt.Sprintf("%s.txt", ft)
}

func ParseInputType(inpType int) (FileType, bool) {
	switch {
	case inpType < 0:
		return "", false
	case inpType == 0:
		return PuzzleInput, true
	default:
		return TestInput(inpType), true
	}
}
