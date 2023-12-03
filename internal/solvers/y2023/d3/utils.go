package d3

import "fmt"

type ftype int

const (
	ftypeNil ftype = iota
	ftypeNr
	ftypeSymbol
)

type field interface {
	Type() ftype
	Print()
}

type nilField struct{}

func (f nilField) Type() ftype {
	return ftypeNil
}
func (f nilField) Print() {
	fmt.Print(".")
}

type nrField struct {
	Val                rune
	IsAdjacentToSymbol bool
}

func (f nrField) Type() ftype {
	return ftypeNr
}
func (f nrField) Print() {
	if f.IsAdjacentToSymbol {
		fmt.Printf("\033[0;32m%s\033[0m", string(f.Val))
	} else {
		fmt.Printf("\033[0;31m%s\033[0m", string(f.Val))
	}
}

type symbolField struct {
	Val rune
}

func (f symbolField) Type() ftype {
	return ftypeSymbol
}
func (f symbolField) Print() {
	fmt.Printf("\033[0;36m%s\033[0m", string(f.Val))
}
