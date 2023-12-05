package d5

import (
	"context"
	"math"
	"strconv"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
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

		mapType, ranges := parseMap(chunk)
		maps[mapType] = ranges
	}

	lowest := math.MaxInt

	logger.Debug("Parsed ", "maps", maps)
	for _, seed := range seeds {
		intermediate := processSeed(seed, maps)
		if lowest > intermediate {
			lowest = intermediate
		}
	}

	return problem.IntAnswer(lowest), nil
}
