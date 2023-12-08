package d8

import "regexp"

var re = regexp.MustCompile("^([A-Z]+) = \\(([A-Z]+), ([A-Z]+)\\)")

func parseInput(inp []string) ([]string, nodeMap) {
	rawNodeLines := txt.ReadLines(inp[1])
	nodeMapping := make(nodeMap, len(rawNodeLines))
	for _, line := range rawNodeLines {
		matches := re.FindStringSubmatch(line)
		nodeMapping[matches[1]] = map[string]string{
			"L": matches[2],
			"R": matches[3],
		}
	}

	return strings.Split(inp[0], ""), nodeMapping
}
