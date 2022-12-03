package day1

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"gotest.tools/v3/assert"
	"testing"
	"time"
)

func TestSolver_SolvePartOne(t *testing.T) {
	ctx, cancel := context.WithTimeout(context.TODO(), time.Second * 5)
	defer cancel()
	solver := Solver {
		Input: util.NewInput(util.ResolveInputFile(1)),
	}
	solution, _ := solver.SolvePartOne(ctx)
	assert.Equal(t, *solution, 24000)
}

func TestSolver_SolvePartTwo(t *testing.T) {
	ctx, cancel := context.WithTimeout(context.TODO(), time.Second * 5)
	defer cancel()
	solver := Solver {
		Input: util.NewInput(util.ResolveInputFile(1)),
	}
	solution, _ := solver.SolvePartTwo(ctx)
	assert.Equal(t, *solution, 45000)
}
