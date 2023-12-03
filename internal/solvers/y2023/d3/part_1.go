package d3

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	parsed := parse(inp)

	// Here is the real smots
	sum := 0
	var lastNr *nrField
	for _, row := range parsed {
		for i := 0; i < len(row); i++ {
			if field, ok := row[i].(*nrField); ok {
				if field != lastNr {
					lastNr = field
					if field.IsAdjacentToSymbol {
						sum += field.Value()
					}
					row[i].Print()
				}
			} else {
				row[i].Print()
			}
		}
		fmt.Println()
	}

	return problem.IntAnswer(sum), nil
}
