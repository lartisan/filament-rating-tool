<?php

namespace Lartisan\RatingTool\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Tables\Columns\Concerns;

class RatingEntry extends Entry
{
    use Concerns\HasColor {
        getColor as getBaseColor;
    }
    use Concerns\HasIcon {
        getIcon as getBaseIcon;
    }


    protected TextEntrySize | string | Closure | null $size = null;
    protected TextEntrySize | string | Closure | null $maxValue = null;

    protected string $view = 'filament-rating-tool::infolists.components.rating-entry';

    public function size(TextEntrySize | string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(mixed $state): TextEntrySize | string | null
    {
        return $this->evaluate($this->size, [
            'state' => $state,
        ]);
    }

    public function maxValue(TextEntrySize | int | Closure | null $maxValue): static
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    public function getMaxValue(mixed $state): TextEntrySize | string | null
    {
        return $this->evaluate($this->maxValue, [
            'state' => $state,
        ]);
    }
}
