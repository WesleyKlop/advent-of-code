package util

import "strconv"

func MapStringsToInt(list *[]string) *[]int {
	ints := make([]int, len(*list))
	var err error
	for i, s := range *list {
		ints[i], err = strconv.Atoi(s)
		if err != nil {
			panic(err)
		}
	}
	return &ints
}
