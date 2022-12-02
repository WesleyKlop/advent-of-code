package util

import "strings"

type Input struct {
	FileName string
	Content  []byte
}

func (i *Input) AllContent() string {
	return string(i.Content)
}

func (i *Input) AllTrimmed() string {
	return strings.Trim(i.AllContent(), "\n")
}

func (i *Input) Lines() []string {
	return i.SplitOn("\n")
}

func (i *Input) SplitOn(sep string) []string {
	return strings.Split(i.AllTrimmed(), sep)
}
