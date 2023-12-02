package d1

import (
	"context"
	"strconv"
	"strings"
	"unicode"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	lines, err := inp.ReadLines()
	if err != nil {
		return problem.NoAnswer, err
	}

	sum := 0
	for _, str := range lines {
		str = "bb" + str + "bb"
		digits := ""
		strLen := len(str)
		for idx := 0; idx < strLen; idx++ {
			if unicode.IsDigit(rune(str[idx])) {
				digits += string(str[idx])
				break
			}
			if idx+5 < strLen {
				if number, isValidNumber := txt.ExtractNumberFromString(str[idx:idx+5], strings.HasPrefix); isValidNumber {
					// First char * 10
					digits += strconv.FormatInt(int64(number), 10)
					break
				}
			}
		}

		for idx := strLen - 1; idx >= 0; idx-- {
			if unicode.IsDigit(rune(str[idx])) {
				digits += string(str[idx])
				break
			}
			if idx-4 > 0 {
				if number, isValidNumber := txt.ExtractNumberFromString(str[idx-4:idx+1], strings.HasSuffix); isValidNumber {
					digits += strconv.FormatInt(int64(number), 10)
					break
				}
			}
		}

		val, _ := strconv.Atoi(digits)
		sum += val
	}
	return problem.IntAnswer(sum), nil
}
