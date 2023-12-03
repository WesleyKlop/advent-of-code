package d3

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
	"strconv"
	"unicode"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	parsed := txt.MapRunesByLine(inp.MustReadLines(), func(c rune) field {
		switch {
		case c == '.':
			return &nilField{}
		case unicode.IsNumber(c):
			return &nrField{Val: c}
		default:
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
	lastNrCounts := false
	lastNr := ""
	for _, row := range parsed {
		for i := 0; i < len(row); i++ {
			row[i].Print()
			if field, ok := row[i].(*nrField); ok {
				lastNr += string(field.Val)
				lastNrCounts = lastNrCounts || field.IsAdjacentToSymbol
			} else {
				if val, err := strconv.Atoi(lastNr); err == nil && lastNrCounts {
					sum += val
				}
				lastNr = ""
				lastNrCounts = false
			}
		}
		fmt.Println()
		if val, err := strconv.Atoi(lastNr); err == nil && lastNrCounts {
			sum += val
		}
		lastNr = ""
		lastNrCounts = false
	}

	return problem.IntAnswer(sum), nil
}
