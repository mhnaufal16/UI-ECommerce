@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola katalog produk dan harga')

@section('content')

{{-- Header Action --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <div class="bg-white border border-gray-200 rounded-xl px-3 py-2 flex items-center gap-2 w-56">
            <i class="fas fa-search text-gray-400 text-xs"></i>
            <input type="text" placeholder="Cari produk..." class="bg-transparent text-sm outline-none w-full text-gray-600 placeholder-gray-400" aria-label="Cari produk">
        </div>
    </div>
    <button onclick="openModal('modal-tambah-produk')"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
        <i class="fas fa-plus text-xs"></i> Tambah Produk
    </button>
</div>

{{-- Products Table --}}
@php
$products = [
    ['no' => 1, 'name' => 'Neon Box LED Akrilik',      'category' => 'Neon Box',      'price' => 'Rp 750.000', 'status' => 'aktif',    'icon' => 'fa-lightbulb', 'color' => 'blue'],
    ['no' => 2, 'name' => 'Reklame Akrilik Custom',    'category' => 'Reklame',       'price' => 'Rp 500.000', 'status' => 'aktif',    'icon' => 'fa-sign',      'color' => 'purple'],
    ['no' => 3, 'name' => 'Letter Timbul Stainless',   'category' => 'Letter Timbul', 'price' => 'Rp 200.000', 'status' => 'aktif',    'icon' => 'fa-font',      'color' => 'gray'],
    ['no' => 4, 'name' => 'Baliho Flexi Digital',      'category' => 'Baliho',        'price' => 'Rp 30.000',  'status' => 'aktif',    'icon' => 'fa-image',     'color' => 'green'],
    ['no' => 5, 'name' => 'Signage Direktori Kantor',  'category' => 'Signage',       'price' => 'Rp 350.000', 'status' => 'nonaktif', 'icon' => 'fa-building',  'color' => 'cyan'],
];
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm data-table">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga/m²</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 bg-white" id="products-tbody">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4 text-gray-400 text-xs">{{ $product['no'] }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-{{ $product['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $product['icon'] }} text-{{ $product['color'] }}-600"></i>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $product['name'] }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2.5 py-1 rounded-full">{{ $product['category'] }}</span>
                    </td>
                    <td class="px-5 py-4 font-semibold text-gray-900">{{ $product['price'] }}</td>
                    <td class="px-5 py-4">
                        <x-badge status="{{ $product['status'] }}" />
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <button onclick="openModal('modal-edit-produk')"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>Edit
                            </button>
                            <button onclick="toggleStatus(this, '{{ $product['status'] }}')"
                                    class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition-colors
                                        {{ $product['status'] === 'aktif' ? 'text-red-600 bg-red-50 hover:bg-red-100' : 'text-green-600 bg-green-50 hover:bg-green-100' }}">
                                <i class="fas {{ $product['status'] === 'aktif' ? 'fa-toggle-off' : 'fa-toggle-on' }} text-[10px]"></i>
                                {{ $product['status'] === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Empty State (shown when no products) --}}
    <div id="products-empty" class="hidden">
        <x-empty-state
            icon="fa-box"
            title="Belum ada produk"
            message="Tambahkan produk pertama Anda untuk mulai menerima order."
            action="true"
            actionLabel="Tambah Produk"
            actionHref="#"
        />
    </div>
</div>

{{-- Add Product Modal --}}
<x-modal id="modal-tambah-produk" title="Tambah Produk Baru" size="lg">
    <div class="space-y-4">
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" placeholder="Contoh: Neon Box LED Premium"
                       class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                       aria-label="Nama produk">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Kategori produk">
                    <option value="">Pilih Kategori</option>
                    <option value="neon-box">Neon Box</option>
                    <option value="reklame">Reklame</option>
                    <option value="letter-timbul">Letter Timbul</option>
                    <option value="baliho">Baliho</option>
                    <option value="signage">Signage</option>
                    <option value="branding">Branding</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga Dasar (per m²) <span class="text-red-500">*</span></label>
                <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                    <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">Rp</span>
                    <input type="number" placeholder="750000" min="0"
                           class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                           aria-label="Harga dasar">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea rows="3" placeholder="Deskripsi singkat produk..."
                          class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                          aria-label="Deskripsi produk"></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Status produk">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button onclick="closeModal('modal-tambah-produk')"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors">
            <i class="fas fa-save mr-1.5"></i>Simpan Produk
        </button>
    </x-slot>
</x-modal>

{{-- Edit Product Modal --}}
<x-modal id="modal-edit-produk" title="Edit Produk" size="lg">
    <div class="space-y-4">
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" value="Neon Box LED Akrilik"
                       class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                       aria-label="Nama produk">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Kategori produk">
                    <option value="neon-box" selected>Neon Box</option>
                    <option value="reklame">Reklame</option>
                    <option value="letter-timbul">Letter Timbul</option>
                    <option value="baliho">Baliho</option>
                    <option value="signage">Signage</option>
                    <option value="branding">Branding</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga Dasar (per m²) <span class="text-red-500">*</span></label>
                <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                    <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">Rp</span>
                    <input type="number" value="750000" min="0"
                           class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                           aria-label="Harga dasar">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea rows="3"
                          class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                          aria-label="Deskripsi produk">Neon box dengan material akrilik premium dan lampu LED hemat energi. Cocok untuk toko, restoran, dan klinik.</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Status produk">
                    <option value="aktif" selected>Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-produk')"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors">
            <i class="fas fa-save mr-1.5"></i>Simpan Perubahan
        </button>
    </x-slot>
</x-modal>

@endsection

@push('scripts')
<script>
function toggleStatus(btn, currentStatus) {
    const isActive = currentStatus === 'aktif';
    const newStatus = isActive ? 'nonaktif' : 'aktif';
    // In real app, this would make an AJAX call
    alert(`Status akan diubah menjadi: ${newStatus}`);
}
</script>
@endpush
