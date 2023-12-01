package d1

import (
	"unicode"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(inp input.Input) (problem.Answer, error) {
	lines, err := inp.ReadLines()
	if err != nil {
		return problem.NoAnswer, err
	}
	sum := 0
	for _, str := range lines {
		digits := 0
		for _, char := range str {
			if unicode.IsDigit(char) {
				// First char * 10
				digits = int(char-'0') * 10
				break
			}
		}
		for i := len(str) - 1; i >= 0; i-- {
			if unicode.IsDigit(rune(str[i])) {
				// Second char
				digits += int(str[i] - '0')
				break
			}
		}
		sum += digits
	}
	return problem.IntAnswer(sum), nil
}
