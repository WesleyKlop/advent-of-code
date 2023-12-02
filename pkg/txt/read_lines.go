package txt

import "strings"

func ReadLines(inp string) []string {
	return ReadSeparatedBy(inp, "\n")
}

func ReadSeparatedBy(inp string, sep string) []string {
	return strings.Split(strings.Trim(inp, sep), sep)
}
