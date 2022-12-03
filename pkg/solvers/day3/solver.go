package day3

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type Solver struct {
	Input *util.Input
}


func (s *Solver) Parse() [][]string {
	return util.Map(s.Input.Lines(), func(t string) []string {
		return strings.Split(t, " ")
	})
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {


}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
return nil, util.Todo{}
}
