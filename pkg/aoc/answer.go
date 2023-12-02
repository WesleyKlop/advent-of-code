package aoc

import (
	"log/slog"

	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

type Answer struct {
	year   Year
	day    Day
	part   Part
	answer problem.Answer
}

func (a Answer) String() string {
	return a.answer.String()
}

func (a Answer) Display() {
	slog.Info("Solution to problem", "year", a.year, "day", a.day, "part", a.part, "answer", a.answer.String())
}
