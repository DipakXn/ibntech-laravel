<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

abstract class DashboardTrendChart extends ChartWidget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected ?string $pollingInterval = null;

    protected ?string $maxHeight = '9rem';

    protected function getType(): string
    {
        return 'line';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'ticks' => [
                        'autoSkip' => true,
                        'maxTicksLimit' => 6,
                        'maxRotation' => 0,
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
            'elements' => [
                'point' => [
                    'radius' => 0,
                    'hitRadius' => 8,
                ],
            ],
        ];
    }

    /**
     * @param  list<int>  $data
     * @return array<string, mixed>
     */
    protected function dataset(string $label, array $data, string $color): array
    {
        return [
            'label' => $label,
            'data' => $data,
            'borderColor' => $color,
            'backgroundColor' => $this->chartFill($color),
            'pointBackgroundColor' => $color,
            'tension' => 0.3,
            'fill' => true,
        ];
    }

    private function chartFill(string $hex): string
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) !== 6) {
            return 'rgba(46, 46, 128, 0.12)';
        }

        $red = hexdec(substr($hex, 0, 2));
        $green = hexdec(substr($hex, 2, 2));
        $blue = hexdec(substr($hex, 4, 2));

        return "rgba({$red}, {$green}, {$blue}, 0.12)";
    }
}
