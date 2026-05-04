@props([
    'title'      => '',
    'value'      => '',
    'icon'       => 'fa-chart-bar',
    'color'      => 'blue',
    'change'     => null,
    'changeType' => 'up',
    'subtitle'   => null,
])

@php
$colors = [
    'blue'   => ['icon' => 'bg-blue-100 text-blue-600'],
    'green'  => ['icon' => 'bg-green-100 text-green-600'],
    'yellow' => ['icon' => 'bg-yellow-100 text-yellow-600'],
    'purple' => ['icon' => 'bg-purple-100 text-purple-600'],
    'red'    => ['icon' => 'bg-red-100 text-red-600'],
    'cyan'   => ['icon' => 'bg-cyan-100 text-cyan-600'],
];
$c = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 stat-card">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $value }}</p>
            @if($subtitle)
            <p class="text-xs text-gray-400 mt-1">{{ $subtitle }}</p>
            @endif
            @if($change)
            <div class="flex items-center gap-1 mt-2">
                <i class="fas {{ $changeType === 'up' ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500' }} text-xs"></i>
                <span class="text-xs font-medium {{ $changeType === 'up' ? 'text-green-600' : 'text-red-600' }}">{{ $change }}</span>
                <span class="text-xs text-gray-400">vs bulan lalu</span>
            </div>
            @endif
        </div>
        <div class="w-12 h-12 {{ $c['icon'] }} rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas {{ $icon }} text-lg"></i>
        </div>
    </div>
</div>
