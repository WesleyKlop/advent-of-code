package common

import (
	"log/slog"
	"os"
	"time"

	"github.com/lmittmann/tint"
)

var logLevels = map[string]slog.Level{
	"debug": slog.LevelDebug,
	"info":  slog.LevelInfo,
	"warn":  slog.LevelWarn,
	"error": slog.LevelError,
}

func ConfigureLogger() {
	if lvl, ok := logLevels[os.Getenv("LOG_LEVEL")]; ok {
		ResetLogger(lvl)
	}
}

func ResetLogger(level slog.Leveler) {
	if level == nil {
		level = slog.LevelWarn
	}
	slog.SetDefault(slog.New(tint.NewHandler(os.Stdout, &tint.Options{
		Level:      level,
		TimeFormat: time.TimeOnly,
	})))
}
