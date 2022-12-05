package util

import (
	"fmt"
	"os"
	"strings"
)

type Input struct {
	FileName string
	Content  []byte
}

func NewInput(fileName string) (input *Input) {
	input = &Input{
		FileName: fileName,
	}
	if content, err := os.ReadFile(input.FileName); err != nil {
		panic("Could not find requested file..." + fileName)
	} else {
		input.Content = content
	}
	return
}

func ResolveInputFile(day int) string {
	wd, _ := os.Getwd()
	split := strings.Split(wd, "/advent-of-code")[0]
	return fmt.Sprintf("%s/advent-of-code/inputs/day%d/test.txt", split, day)
}

func (i *Input) AllContent() string {
	return string(i.Content)
}

func (i *Input) AllTrimmed() string {
	return strings.Trim(i.AllContent(), "\n")
}

func (i *Input) Lines() []string {
	return i.SplitOn("\n")
}

func (i *Input) SplitOn(sep string) []string {
	return strings.Split(i.AllTrimmed(), sep)
}
