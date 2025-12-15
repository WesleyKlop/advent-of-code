package main

import (
	"bufio"
	"errors"
	"io"
	"strconv"
	"strings"
)

type Range [2]int

func (r Range) IDsInRangeRepeatedTwice() func(func(i int) bool) {
	return func(f func(i int) bool) {
		for i := range r.IDs() {
			id := strconv.FormatInt(int64(i), 10)
			// Must be able to split id in half
			if len(id)%2 != 0 {
				continue
			}
			l, r := id[:len(id)/2], id[len(id)/2:]
			if l == r {
				f(i)
			}
		}
	}
}

func (r Range) IDsInRangeRepeatedAny() func(func(i int) bool) {
	return func(f func(i int) bool) {
		for i := range r.IDs() {
			asStr := strconv.FormatInt(int64(i), 10)

			// windowSize can never be larger than half of the str len
		inner:
			for windowSize := 1; windowSize <= len(asStr)/2; windowSize++ {
				// windowSize must fit exactly N times in the str
				if len(asStr)%windowSize != 0 {
					continue
				}
				window := asStr[0:windowSize]
				fits := len(asStr) / windowSize

				if strings.Repeat(window, fits) == asStr {
					f(i)
					break inner
				}
			}
		}
	}
}

func (r Range) IDs() func(func(i int) bool) {
	return func(f func(i int) bool) {
		for i := r[0]; i <= r[1]; i++ {
			f(i)
		}
	}
}

func parseInput(in io.Reader) []Range {
	reader := bufio.NewReader(in)
	r, i := Range{}, 0
	out := make([]Range, 0, 1024)

	for {
		b, err := reader.ReadByte()
		if err != nil && !errors.Is(err, io.EOF) {
			panic(err)
		}
		if err != nil || b == '\n' {
			out = append(out, r)
			break
		}

		switch b {
		case ',':
			out = append(out, r)
			r, i = Range{}, 0
		case '-':
			i = 1
		default:
			r[i] = r[i]*10 + int(b-'0')
		}
	}
	return out
}
