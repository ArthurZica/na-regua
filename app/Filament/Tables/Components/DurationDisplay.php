<?php

namespace App\Filament\Tables\Components;

class DurationDisplay
{
    public static function format(int $minutes): string
    {
        $h = floor($minutes / 60);
        $m = $minutes % 60;

        if ($h > 0 && $m > 0) {
            return "{$h}h {$m}min";
        } elseif ($h > 0) {
            return "{$h}h";
        } else {
            return "{$m}min";
        }
    }
}
