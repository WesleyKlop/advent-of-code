package txt

import "strings"

func ReadLines(inp string) []string {
	return ReadSplitOn(inp, "\n")
}

func ReadSplitOn(inp string, sep string) []string {
	return strings.Split(strings.Trim(inp, sep), sep)
}
