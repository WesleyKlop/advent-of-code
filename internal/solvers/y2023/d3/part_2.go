package d3

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	parsed := parse(inp)

	// Here is the real smots v2
	groups := make(map[*symbolField]map[*nrField]struct{})
	empty := struct{}{}
	collections.ForEachSurroundingCell(parsed, func(val field, surrounding field) {
		var ok bool
		var sf *symbolField
		var nf *nrField

		// Only consider gears
		if sf, ok = val.(*symbolField); !ok || sf.Val != '*' {
			return
		}
		if nf, ok = surrounding.(*nrField); !ok {
			return
		}

		if _, ok := groups[sf]; !ok {
			groups[sf] = make(map[*nrField]struct{})
		}
		groups[sf][nf] = empty
	})

	sum := 0
	for _, set := range groups {
		if len(set) != 2 {
			continue
		}
		product := 1
		for k, _ := range set {
			product *= k.Value()
		}
		sum += product
	}

	return problem.IntAnswer(sum), nil
}
