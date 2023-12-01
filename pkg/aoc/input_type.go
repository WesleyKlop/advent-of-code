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
