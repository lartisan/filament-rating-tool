<?php

namespace Lartisan\RatingTool\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Support\Contracts\HasColor as ColorInterface;
use Filament\Support\Contracts\HasIcon as IconInterface;

class RatingInput extends Field
{
    protected TextEntrySize | string | Closure | null $size = null;
    protected string | array | bool | Closure | null $color = null;
    protected string | bool | Closure | null $icon = null;
    protected TextEntrySize | string | Closure | null $maxValue = null;

    protected string $view = 'filament-rating-tool::forms.components.rating-input';

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

    public function color(string | array | bool | Closure | null $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getColor(mixed $state): string | array | null
    {
        $color = $this->evaluate($this->color, [
            'state' => $state,
        ]);

        if ($color === false) {
            return null;
        }

        if (filled($color)) {
            return $color;
        }

        if (! $state instanceof ColorInterface) {
            return null;
        }

        return $state->getColor();
    }

    public function icon(string | bool | Closure | null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(mixed $state): ?string
    {
        $icon = $this->evaluate($this->icon, [
            'state' => $state,
        ]);

        if ($icon === false) {
            return null;
        }

        if (filled($icon)) {
            return $icon;
        }

        if (! $state instanceof IconInterface) {
            return null;
        }

        return $state->getIcon();
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
