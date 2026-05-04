@props([
    'id'    => 'modal',
    'title' => 'Modal',
    'size'  => 'md',
])

@php
$sizes = ['sm' => 'max-w-md', 'md' => 'max-w-lg', 'lg' => 'max-w-2xl', 'xl' => 'max-w-4xl'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div id="{{ $id }}"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('{{ $id }}')"></div>

    <div class="relative w-full {{ $sizeClass }} bg-white rounded-2xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="{{ $id }}-dialog">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="{{ $id }}-title" class="font-semibold text-gray-900 text-base">{{ $title }}</h3>
            <button onclick="closeModal('{{ $id }}')"
                    class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors"
                    aria-label="Tutup modal">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <div class="px-6 py-5">
            {{ $slot }}
        </div>

        @if(isset($footer))
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50 rounded-b-2xl">
            {{ $footer }}
        </div>
        @endif
    </div>
</div>

@once
@push('scripts')
<script>
function openModal(id) {
    const modal = document.getElementById(id);
    const dialog = document.getElementById(id + '-dialog');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        dialog.classList.remove('scale-95', 'opacity-0');
        dialog.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    const modal = document.getElementById(id);
    const dialog = document.getElementById(id + '-dialog');
    dialog.classList.remove('scale-100', 'opacity-100');
    dialog.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }, 200);
}
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('[role="dialog"]:not(.hidden)').forEach(m => closeModal(m.id));
    }
});
</script>
@endpush
@endonce
