@props([
    'variant'   => 'primary',
    'size'      => 'md',
    'href'      => null,
    'type'      => 'button',
    'icon'      => null,
    'iconRight' => null,
    'disabled'  => false,
    'class'     => '',
])

@php
$variants = [
    'primary'   => 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-sm hover:shadow-blue-200 hover:shadow-md',
    'secondary' => 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 hover:border-gray-300 shadow-sm',
    'danger'    => 'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white shadow-sm',
    'success'   => 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-sm',
    'ghost'     => 'text-gray-600 hover:text-blue-600 hover:bg-blue-50',
    'whatsapp'  => 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-sm hover:shadow-green-200 hover:shadow-md',
    'outline'   => 'border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white',
];
$sizes = [
    'xs' => 'px-3 py-1.5 text-xs',
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-5 py-2.5 text-sm',
    'lg' => 'px-6 py-3 text-base',
    'xl' => 'px-8 py-4 text-lg',
];
$base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
$variantClass = $variants[$variant] ?? $variants['primary'];
$sizeClass    = $sizes[$size] ?? $sizes['md'];
$classes = "$base $variantClass $sizeClass $class";
@endphp

@if($href)
<a href="{{ $href }}" class="{{ $classes }}" {{ $disabled ? 'aria-disabled=true' : '' }}>
    @if($icon)<i class="fas {{ $icon }} text-sm"></i>@endif
    {{ $slot }}
    @if($iconRight)<i class="fas {{ $iconRight }} text-sm"></i>@endif
</a>
@else
<button type="{{ $type }}" class="{{ $classes }}" {{ $disabled ? 'disabled' : '' }}>
    @if($icon)<i class="fas {{ $icon }} text-sm"></i>@endif
    {{ $slot }}
    @if($iconRight)<i class="fas {{ $iconRight }} text-sm"></i>@endif
</button>
@endif
