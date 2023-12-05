package d5

import (
	"context"
	"fmt"
	"math"
	"strconv"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

var processingOrder = [...]string{
	"seed-to-soil",
	"soil-to-fertilizer",
	"fertilizer-to-water",
	"water-to-light",
	"light-to-temperature",
	"temperature-to-humidity",
	"humidity-to-location",
}

func part1(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)

	maps := make(map[string][]convRange)
	seeds := make([]int, 0)
	for idx, chunk := range inp.MustReadSplitOn("\n\n") {
		// parse seeds
		if idx == 0 {
			rawSeeds, _ := strings.CutPrefix(chunk, "seeds: ")
			for _, rawSeed := range strings.Fields(rawSeeds) {
				seed, _ := strconv.Atoi(rawSeed)
				seeds = append(seeds, seed)
			}
			continue
		}

		// parse maps
		mapType, contents, ok := strings.Cut(chunk, " map:\n")
		if !ok {
			panic(fmt.Sprintf("failed to parse idx %d", idx))
		}

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

		maps[mapType] = ranges
	}

	lowest := math.MaxInt

	logger.Debug("Parsed ", "maps", maps)
	for _, seed := range seeds {
		intermediate := seed
	conversion:
		for _, mapType := range processingOrder {
			for _, conversion := range maps[mapType] {
				//logger.Debug("processing conversion", "src", conversion.SrcStart, "range", conversion.Range)
				if conversion.IsInSrcRange(intermediate) {
					converted := conversion.Convert(intermediate)
					intermediate = converted
					continue conversion
				}
			}
		}
		if lowest > intermediate {
			lowest = intermediate
		}
	}

	return problem.IntAnswer(lowest), nil
}
