package d5

import (
	"fmt"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

func processSeed(seed int, maps map[string][]convRange) int {
conversion:
	for _, mapType := range processingOrder {
		for _, conversion := range maps[mapType] {
			//logger.Debug("processing conversion", "src", conversion.SrcStart, "range", conversion.Range)
			if conversion.IsInSrcRange(seed) {
				seed = conversion.Convert(seed)
				continue conversion
			}
		}
	}
	return seed
}

func parseMap(input string) (string, []convRange) {
	mapType, contents, _ := strings.Cut(input, " map:\n")

	rawRanges := txt.ReadLines(contents)
	ranges := make([]convRange, 0, len(rawRanges))
	for _, line := range rawRanges {
		var src, dest, size int
		_, _ = fmt.Sscanf(line, "%d %d %d", &dest, &src, &size)
		ranges = append(ranges, convRange{
			SrcStart:  src,
			DestStart: dest,
			Range:     size,
		})
	}
	return mapType, ranges
}
