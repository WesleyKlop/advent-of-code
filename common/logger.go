package common

import (
	"log/slog"
	"os"
	"time"

	"github.com/lmittmann/tint"
)

func ResetLogger(level slog.Leveler) {
	if level == nil {
		level = slog.LevelWarn
	}
	slog.SetDefault(slog.New(tint.NewHandler(os.Stdout, &tint.Options{
		Level:      level,
		TimeFormat: time.TimeOnly,
	})))
}
