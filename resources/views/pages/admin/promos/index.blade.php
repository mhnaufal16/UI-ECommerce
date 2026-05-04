@extends('layouts.admin')

@section('title', 'Diskon & Promo - Admin')
@section('page-title', 'Diskon & Promo')
@section('page-subtitle', 'Kelola kode voucher dan diskon')

@section('content')

<div class="grid lg:grid-cols-5 gap-6">

    {{-- ===== LEFT: Create Form ===== --}}
    <div class="lg:col-span-2">
        <x-card title="Buat Voucher Baru" subtitle="Tambahkan kode promo baru">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Kode Voucher <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="voucher-code" placeholder="Contoh: HEMAT20"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all uppercase font-mono font-bold tracking-wider"
                           oninput="this.value = this.value.toUpperCase()"
                           aria-label="Kode voucher">
                    <p class="text-xs text-gray-400 mt-1">Gunakan huruf kapital dan angka, tanpa spasi.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tipe Diskon <span class="text-red-500">*</span>
                    </label>
                    <select id="discount-type" onchange="toggleDiscountInput()"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white"
                            aria-label="Tipe diskon">
                        <option value="percent">Persentase (%)</option>
                        <option value="flat">Nominal Tetap (Rp)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nilai Diskon <span class="text-red-500">*</span>
                    </label>
                    <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                        <span id="discount-prefix" class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200 min-w-[40px] text-center">%</span>
                        <input type="number" id="discount-value" placeholder="10" min="0"
                               class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                               aria-label="Nilai diskon">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Berlaku Hingga</label>
                    <input type="date" value="2025-12-31"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                           aria-label="Tanggal berlaku">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Minimal Order</label>
                    <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                        <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">Rp</span>
                        <input type="number" placeholder="500000" min="0"
                               class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                               aria-label="Minimal order">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ada minimal order.</p>
                </div>

                <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>Buat Voucher
                </button>
            </div>
        </x-card>
    </div>

    {{-- ===== RIGHT: Promo Table ===== --}}
    <div class="lg:col-span-3">
        <x-card title="Daftar Voucher" subtitle="4 voucher terdaftar">
            @php
            $promos = [
                ['code' => 'HEMAT10',  'type' => 'Persen',  'value' => '10%',         'min_order' => 'Rp 500.000',  'expires' => '31 Des 2025', 'status' => 'aktif'],
                ['code' => 'GRATIS50', 'type' => 'Flat',    'value' => 'Rp 50.000',   'min_order' => 'Rp 300.000',  'expires' => '30 Jun 2025', 'status' => 'aktif'],
                ['code' => 'APKREASI', 'type' => 'Persen',  'value' => '15%',         'min_order' => 'Rp 1.000.000','expires' => '31 Mar 2025', 'status' => 'nonaktif'],
                ['code' => 'NEWUSER',  'type' => 'Flat',    'value' => 'Rp 100.000',  'min_order' => 'Rp 500.000',  'expires' => '28 Feb 2025', 'status' => 'nonaktif'],
            ];
            @endphp

            <div class="overflow-x-auto -mx-6 -mb-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-y border-gray-100">
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nilai</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Min. Order</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Berlaku Hingga</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        @foreach($promos as $promo)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4">
                                <span class="font-mono font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-lg text-xs">{{ $promo['code'] }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-1 rounded-full">{{ $promo['type'] }}</span>
                            </td>
                            <td class="px-5 py-4 font-bold text-gray-900 text-sm">{{ $promo['value'] }}</td>
                            <td class="px-5 py-4 text-gray-500 text-xs">{{ $promo['min_order'] }}</td>
                            <td class="px-5 py-4 text-gray-500 text-xs">{{ $promo['expires'] }}</td>
                            <td class="px-5 py-4">
                                <x-badge status="{{ $promo['status'] }}" />
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1.5">
                                    <button onclick="openModal('modal-edit-promo')"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <i class="fas fa-edit text-[10px]"></i>Edit
                                    </button>
                                    <button onclick="confirmDelete('{{ $promo['code'] }}')"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <i class="fas fa-trash text-[10px]"></i>Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>

{{-- Edit Promo Modal --}}
<x-modal id="modal-edit-promo" title="Edit Voucher" size="md">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Voucher</label>
            <input type="text" value="HEMAT10"
                   class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 font-mono font-bold uppercase"
                   aria-label="Kode voucher">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe Diskon</label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Tipe diskon">
                    <option value="percent" selected>Persentase (%)</option>
                    <option value="flat">Nominal Tetap (Rp)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nilai Diskon</label>
                <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 transition-all">
                    <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">%</span>
                    <input type="number" value="10" min="0"
                           class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                           aria-label="Nilai diskon">
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Berlaku Hingga</label>
                <input type="date" value="2025-12-31"
                       class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400"
                       aria-label="Tanggal berlaku">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Status voucher">
                    <option value="aktif" selected>Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-promo')"
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
function toggleDiscountInput() {
    const type = document.getElementById('discount-type').value;
    const prefix = document.getElementById('discount-prefix');
    prefix.textContent = type === 'percent' ? '%' : 'Rp';
}

function confirmDelete(code) {
    if (confirm(`Hapus voucher ${code}? Tindakan ini tidak dapat dibatalkan.`)) {
        // In real app, make AJAX delete request
        alert(`Voucher ${code} berhasil dihapus.`);
    }
}
</script>
@endpush
