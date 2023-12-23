<?php

namespace Lartisan\RatingTool\Tables\Columns;

use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns;
use Filament\Tables\Columns\TextColumn\TextColumnSize;

class RatingColumn extends Column
{
    use Concerns\HasColor {
        getColor as getBaseColor;
    }
    use Concerns\HasIcon {
        getIcon as getBaseIcon;
    }

    protected TextColumnSize | string | Closure | null $size = null;

    protected TextColumnSize | string | Closure | null $maxValue = null;

    protected string $view = 'filament-rating-tool::tables.columns.rating-column';

    public function size(TextColumnSize | string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(mixed $state): TextColumnSize | string | null
    {
        return $this->evaluate($this->size, [
            'state' => $state,
        ]);
    }

    public function maxValue(TextColumnSize | int | Closure | null $maxValue): static
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    public function getMaxValue(mixed $state): TextColumnSize | string | null
    {
        return $this->evaluate($this->maxValue, [
            'state' => $state,
        ]);
    }
}
