@php
    use Filament\Tables\Columns\IconColumn\IconColumnSize;
    use Illuminate\Support\Str;
    use function Filament\Support\get_color_css_variables;
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    @php
        $size = $getSize($getState()) ?? 'lg';
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

        $colorShades = get_color_css_variables($color, shades: [400, 500, 600, 700]);
    @endphp

    <div x-data="{
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
            hoverRating: 0,
            maxValue: {{ $maxValue }},
            get ratings() {
                return this.state ?? 0;
            },
            get remaining() {
                return this.maxValue - this.state;
            },
            rate(value) {
                this.state = value;
            }
        }"
         x-init="console.log(ratings)"
         class="flex items-center"
    >
        <div class="flex items-center space-x-2">
            <template x-for="(star, index) in ratings" :key="index">
                <button type="button"
                        @click="rate(index + 1);"
                        @mouseover="hoverRating = index + 1"
                        @mouseleave="hoverRating = state"
                        aria-hidden="true"
                        @class([
                            match ($color) {
                                'gray' => 'fi-color-gray text-gray-400 dark:text-gray-600',
                                default => 'fi-color-custom text-custom-500 hover:text-custom-700 dark:text-custom-600 hover:dark:text-custom-400',
                            },
                        ])
                        @style([$colorShades => $color !== 'gray'])
                >
                    <x-filament::icon
                            :icon="Str::replace('-o-', '-s-', $icon)"
                            @class(['fi-in-icon-item', $iconSize])
                    />
                </button>
            </template>

            <template x-for="(star, index) in remaining" :key="index">
                <button type="button"
                        @click="rate(state + index + 1);"
                        @mouseover="hoverRating = ratings + index + 1"
                        @mouseleave="hoverRating = ratings"
                        aria-hidden="true"
                        class="fi-color-gray text-gray-400 hover:text-gray-600 dark:text-gray-600 hover:dark:text-gray-400"
                >
                    <x-filament::icon
                            :icon="Str::replace('-s-', '-o-', $icon)"
                            @class(['fi-in-icon-item', $iconSize])
                    />
                </button>
            </template>
        </div>

    </div>
</x-dynamic-component>