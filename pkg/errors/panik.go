package errors

import (
	_ "embed"
	"fmt"
	"log/slog"
)

//go:embed panik.txt
var panik string

func PanicHandler(logger *slog.Logger) {
	if err := recover(); err != nil {
		logger.Error(fmt.Sprintf("%v", err), "panik", "\n"+panik)
	}
}
