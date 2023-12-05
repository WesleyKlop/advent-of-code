package input

import (
	"os"

	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

func (i Input) Read() (string, error) {
	contents, err := os.ReadFile(i.path)
	if err != nil {
		return "", err
	}
	return string(contents), nil
}
func (i Input) ReadLines() ([]string, error) {
	contents, err := i.Read()
	if err != nil {
		return nil, err
	}
	return txt.ReadLines(contents), nil
}

func (i Input) MustReadLines() []string {
	lines, err := i.ReadLines()
	if err != nil {
		panic(err)
	}
	return lines
}

func (i Input) ReadSplitOn(sep string) ([]string, error) {
	contents, err := i.Read()
	if err != nil {
		return nil, err
	}
	return txt.ReadSplitOn(contents, sep), nil
}

func (i Input) MustReadSplitOn(sep string) []string {
	contents, err := i.ReadSplitOn(sep)
	if err != nil {
		panic(err)
	}
	return contents
}
