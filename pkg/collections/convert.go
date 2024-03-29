package collections

import (
	"strconv"
	"strings"
)

func MapStringsToInt(list []string) []int {
	return MapSlice(list, func(t string) int {
		num, _ := strconv.Atoi(t)
		return num
	})
}

func MapSlice[T any, R any](list []T, fn func(T) R) []R {
	newList := make([]R, len(list))
	for i, t := range list {
		newList[i] = fn(t)
	}
	return newList
}

func IntFields(s string) []int {
	return MapStringsToInt(strings.Fields(s))
}
