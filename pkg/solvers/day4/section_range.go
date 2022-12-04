package day4

import (
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type sectionRange struct {
	LowerBound int
	UpperBound int
}

func newSectionRange(ir string) sectionRange {
	bounds := util.MapStringsToInt(strings.Split(ir, "-"))
	return sectionRange{
		LowerBound: bounds[0],
		UpperBound: bounds[1],
	}
}

func (s *sectionRange) FullyContains(other sectionRange) bool {
	return s.LowerBound <= other.LowerBound && s.UpperBound >= other.UpperBound
}
