package common

import "os"

func OpenPuzzleInput() *os.File {
	if f := os.Args[1]; f != "" {
		return Must(os.OpenFile(f, os.O_RDONLY, 0444))
	}
	panic("missing argument file")
}
