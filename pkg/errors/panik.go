package errors

import (
	_ "embed"
	"fmt"
	"os"
)

//go:embed panik.txt
var panik string

func PanicHandler() {
	if err := recover(); err != nil {
		_, err = fmt.Fprintf(os.Stderr, "%s%v\n", panik, err)
		if err != nil {
			panic(err)
		}
	}
}
