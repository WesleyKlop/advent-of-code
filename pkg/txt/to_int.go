package txt

var validNumbers = map[string]int{
	"one":   1,
	"two":   2,
	"three": 3,
	"four":  4,
	"five":  5,
	"six":   6,
	"seven": 7,
	"eight": 8,
	"nine":  9,
	"ten":   10,
}

func ExtractNumberFromString(s string, matcher func(s string, match string) bool) (int, bool) {
	for key, val := range validNumbers {
		if matcher(s, key) {
			return val, true
		}
	}
	return 0, false
}
