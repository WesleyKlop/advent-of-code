package logging

import (
	"log/slog"
	"os"
	"time"

	"github.com/phsym/console-slog"
)

func NewConsole(level slog.Level) *slog.Logger {
	return slog.New(
		console.NewHandler(os.Stdout, &console.HandlerOptions{
			Level:      level,
			TimeFormat: time.TimeOnly,
		}),
	)
}

func LevelFromBool(debug bool) slog.Level {
	if debug {
		return slog.LevelDebug
	}
	return slog.LevelInfo
}
