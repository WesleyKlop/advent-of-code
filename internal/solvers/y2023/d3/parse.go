package d3

import (
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
	"unicode"
)

func parse(inp input.Input) [][]field {
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
	return parsed
}
