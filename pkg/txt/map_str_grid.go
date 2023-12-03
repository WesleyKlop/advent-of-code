package txt

func MapRunesByLine[R any](lines []string, mapFn func(r rune) R) [][]R {
	out := make([][]R, 0, len(lines))
	for _, line := range lines {
		outLine := make([]R, 0, len(line))
		for _, char := range line {
			outLine = append(outLine, mapFn(char))
		}
		out = append(out, outLine)
	}
	return out
}
