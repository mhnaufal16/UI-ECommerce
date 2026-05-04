@props([
    'title'    => null,
    'subtitle' => null,
    'padding'  => 'p-6',
    'hover'    => false,
    'class'    => '',
])

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm {{ $hover ? 'card-hover cursor-pointer' : '' }} {{ $class }}">
    @if($title)
    <div class="px-6 pt-5 pb-4 border-b border-gray-50 flex items-center justify-between">
        <div>
            <h3 class="font-semibold text-gray-900 text-base">{{ $title }}</h3>
            @if($subtitle)
            <p class="text-xs text-gray-400 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
        @if(isset($action))
        <div>{{ $action }}</div>
        @endif
    </div>
    @endif
    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
</div>
