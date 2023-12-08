package d8

import (
	"regexp"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

type nodeMap map[string]map[string]string

var re = regexp.MustCompile("^([A-Z0-9]+) = \\(([A-Z0-9]+), ([A-Z0-9]+)\\)")

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
