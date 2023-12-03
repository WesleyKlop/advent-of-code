package d3

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
	"unicode"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	var lastNrField *nrField
	parsed := txt.MapRunesByLine(inp.MustReadLines(), func(c rune) field {
		switch {
		case c == '.':
			if lastNrField != nil {
				lastNrField = nil
			}
			return &nilField{}
		case unicode.IsNumber(c):
			if lastNrField == nil {
				lastNrField = &nrField{}
			}
			lastNrField.Val = append(lastNrField.Val, c)
			return lastNrField
		default:
			if lastNrField != nil {
				lastNrField = nil
			}
			return &symbolField{Val: c}
		}
	})

	collections.ForEachSurroundingCell(parsed, func(a field, b field) {
		if a.Type() == ftypeNr && b.Type() == ftypeSymbol {
			f := a.(*nrField)
			f.IsAdjacentToSymbol = true
		}
		return
	})

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
