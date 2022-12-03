package day3

import "strings"

type rucksack struct {
	FirstCompartment string
	SecondCompartment string
}

func newRucksack(line string) rucksack {
	size := len(line)
	return rucksack{
		FirstCompartment:  line[0:size/2],
		SecondCompartment: line[size/2:],
	}
}

func getPriority(letter rune) int32 {
	// It is an uppercase letter
	if letter < 97 {
		// Uppercase starts from 65, but add 26
		return letter - 64 + 26
	}
	// a-z have a priority of 1-26
	return letter - 96
}

func GetBadge(rs []rucksack) int {
	for _, char := range rs[0].Content() {
		if strings.ContainsRune(rs[1].Content(), char) && strings.ContainsRune(rs[2].Content(), char) {
			return int(getPriority(char))
		}
	}
	return -1
}

func (r rucksack) GetCommonItem() int {
	for _, char := range r.SecondCompartment {
		if strings.ContainsRune(r.FirstCompartment, char) {
			return int(getPriority(char))
		}
	}
	return -1
}

func (r rucksack) Content() string {
	return r.FirstCompartment + r.SecondCompartment
}