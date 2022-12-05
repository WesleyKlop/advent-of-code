package day5

import (
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

func parseStacks(input []string) []util.Stack[string] {
	maxHeight := len(input) - 1
	amountOfStacks := len(strings.Split(input[maxHeight], "   "))
	crateColumns := make([]util.Stack[string], amountOfStacks)

	// For each crate column
	for i := range crateColumns {
		column := util.MakeStack[string]()
		inputColIdx := 4*i + 1
		// Work from the bottom to the top
		for h := maxHeight - 1; h >= 0; h-- {
			if inputColIdx > len(input[h]) {
				break
			}
			content := string(input[h][inputColIdx])
			if content != " " {
				column.Push(content)
			}
		}
		crateColumns[i] = column
	}
	return crateColumns
}
