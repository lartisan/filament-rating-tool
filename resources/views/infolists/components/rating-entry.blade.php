@php
    use Filament\Tables\Columns\IconColumn\IconColumnSize;
    use Illuminate\Support\Str;
    use function Filament\Support\get_color_css_variables;
@endphp

<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @php
        $size = $getSize($getState()) ?? 'sm';
        $icon = $getIcon($getState()) ?? 'heroicon-o-star';
        $maxValue = $getMaxValue($getState()) ?? 5;
        $color = $getColor($getState()) ?? 'gray';

        $iconSize = match ($size) {
            IconColumnSize::ExtraSmall, 'xs' => 'fi-in-icon-item-size-xs h-3 w-3',
            IconColumnSize::Small, 'sm' => 'fi-in-icon-item-size-sm h-4 w-4',
            IconColumnSize::Medium, 'md' => 'fi-in-icon-item-size-md h-5 w-5',
            IconColumnSize::Large, 'lg' => 'fi-in-icon-item-size-lg h-6 w-6',
            IconColumnSize::ExtraLarge, 'xl' => 'fi-in-icon-item-size-xl h-7 w-7',
            IconColumnSize::TwoExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
            default => $size,
        };

        $colorShades = get_color_css_variables($color, shades: [500, 600]);
    @endphp

    <div class="flex items-center space-x-2">
        @for($i = 1; $i <= ($getState() >= $maxValue ? $maxValue : $getState()); $i++)
            <x-filament::icon
                    :icon="Str::replace('-o-', '-s-', $icon)"
                    @class([
                        'fi-ta-icon-item',
                        $iconSize,
                        match ($color) {
                            'gray' => 'fi-color-gray text-gray-400 dark:text-gray-600',
                            default => 'fi-color-custom text-custom-500 dark:text-custom-500',
                        },
                    ])
                    @style([$colorShades => $color !== 'gray'])
            />
        @endfor

        @if($getState() < $maxValue)
            @for($i=1; $i <= $maxValue - $getState(); $i++)
                <x-filament::icon
                        :icon="Str::replace('-s-', '-o-', $icon)"
                        @class([
                            'fi-ta-icon-item',
                            $iconSize,
                            match ($color) {
                                'gray' => 'fi-color-gray text-gray-400 dark:text-gray-500',
                                default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                            },
                        ])
                        @style([$colorShades => $color !== 'gray'])
                />
            @endfor
        @endif
    </div>
</x-dynamic-component>