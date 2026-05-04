@props([
    'icon'        => 'fa-inbox',
    'title'       => 'Tidak ada data',
    'message'     => 'Belum ada data yang tersedia saat ini.',
    'action'      => null,
    'actionLabel' => 'Tambah Baru',
    'actionHref'  => '#',
])

<div class="flex flex-col items-center justify-center py-16 px-4 text-center">
    <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
        <i class="fas {{ $icon }} text-3xl text-gray-300"></i>
    </div>
    <h3 class="text-base font-semibold text-gray-700 mb-1">{{ $title }}</h3>
    <p class="text-sm text-gray-400 max-w-xs leading-relaxed">{{ $message }}</p>
    @if($action)
    <a href="{{ $actionHref }}" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
        <i class="fas fa-plus text-xs"></i>{{ $actionLabel }}
    </a>
    @endif
</div>
