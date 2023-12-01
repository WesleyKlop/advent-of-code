package input

import (
	"os"
	"strings"
)

func (i Input) ReadLines() ([]string, error) {
	contents, err := os.ReadFile(i.path)
	if err != nil {
		return nil, err
	}
	return strings.Split(
		strings.Trim(string(contents), "\n"),
		"\n"), nil
}
