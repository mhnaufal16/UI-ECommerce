@props(['status' => 'pending', 'size' => 'sm'])

@php
$styles = [
    'inquiry'   => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
    'pending'   => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
    'desain'    => 'bg-blue-100 text-blue-800 border border-blue-200',
    'acc'       => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
    'produksi'  => 'bg-purple-100 text-purple-800 border border-purple-200',
    'dikirim'   => 'bg-cyan-100 text-cyan-800 border border-cyan-200',
    'selesai'   => 'bg-green-100 text-green-800 border border-green-200',
    'cancel'    => 'bg-red-100 text-red-800 border border-red-200',
    'aktif'     => 'bg-green-100 text-green-800 border border-green-200',
    'nonaktif'  => 'bg-gray-100 text-gray-600 border border-gray-200',
];
$icons = [
    'inquiry'   => 'fa-question-circle',
    'pending'   => 'fa-clock',
    'desain'    => 'fa-pencil-ruler',
    'acc'       => 'fa-check-circle',
    'produksi'  => 'fa-industry',
    'dikirim'   => 'fa-truck',
    'selesai'   => 'fa-check-double',
    'cancel'    => 'fa-times-circle',
    'aktif'     => 'fa-circle',
    'nonaktif'  => 'fa-circle',
];
$labels = [
    'inquiry'   => 'Inquiry',
    'pending'   => 'Pending',
    'desain'    => 'Desain',
    'acc'       => 'ACC',
    'produksi'  => 'Produksi',
    'dikirim'   => 'Dikirim',
    'selesai'   => 'Selesai',
    'cancel'    => 'Cancel',
    'aktif'     => 'Aktif',
    'nonaktif'  => 'Nonaktif',
];
$key = strtolower($status);
$style = $styles[$key] ?? 'bg-gray-100 text-gray-600 border border-gray-200';
$icon  = $icons[$key]  ?? 'fa-circle';
$label = $labels[$key] ?? ucfirst($status);
$sizeClass = $size === 'lg' ? 'text-sm px-3 py-1' : 'text-xs px-2.5 py-0.5';
@endphp

<span class="inline-flex items-center gap-1.5 {{ $sizeClass }} rounded-full font-semibold {{ $style }}">
    <i class="fas {{ $icon }} text-[10px]"></i>
    {{ $label }}
</span>
