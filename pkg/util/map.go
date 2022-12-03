package util

import "strconv"

func MapStringsToInt(list []string) []int {
	return Map(list, func(t string) int {
		num, _ := strconv.Atoi(t)
		return num
	})
}

func Map[T any, R any](list []T, fn func(T) R) []R {
	newList := make([]R, len(list))
	for i, t := range list {
		newList[i] = fn(t)
	}
	return newList
}
