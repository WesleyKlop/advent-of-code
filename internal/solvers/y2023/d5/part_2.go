package d5

import (
	"context"
	"fmt"
	"math"
	"strconv"
	"strings"
	"sync"
	"sync/atomic"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"github.com/wesleyklop/advent-of-code/pkg/txt"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	maps := make(map[string][]convRange)
	seedRanges := make([][2]int, 0)
	for idx, chunk := range inp.MustReadSplitOn("\n\n") {
		// parse seeds
		if idx == 0 {
			rawSeeds, _ := strings.CutPrefix(chunk, "seeds: ")
			for i, rawSeed := range strings.Fields(rawSeeds) {
				seed, _ := strconv.Atoi(rawSeed)
				if i%2 == 0 {
					seedRanges = append(seedRanges, [2]int{seed, 0})
				} else {
					seedRanges[i/2][1] = seed
				}
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

	lowest := atomic.Int64{}
	lowest.Store(math.MaxInt)

	wg := sync.WaitGroup{}
	wg.Add(10)
	for _, seedRange := range seedRanges {
		seedRange := seedRange
		go func() {
			defer wg.Done()
			for seed := seedRange[0]; seed < seedRange[0]+seedRange[1]; seed++ {
				intermediate := seed
			conversion:
				for _, mapType := range processingOrder {
					for _, conversion := range maps[mapType] {
						if conversion.IsInSrcRange(intermediate) {
							intermediate = conversion.Convert(intermediate)
							continue conversion
						}
					}
				}
				if lowest.Load() > int64(intermediate) {
					lowest.Store(int64(intermediate))
				}
			}
		}()
	}
	wg.Wait()
	return problem.IntAnswer(lowest.Load()), nil
}
