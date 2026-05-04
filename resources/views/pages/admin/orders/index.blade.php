@extends('layouts.admin')

@section('title', 'Manajemen Order - Admin')
@section('page-title', 'Manajemen Order')
@section('page-subtitle', 'Kelola semua order pelanggan')

@section('content')

{{-- Summary Stat Cards --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['Total',    '156', 'fa-clipboard-list', 'blue'],
        ['Pending',  '23',  'fa-clock',          'yellow'],
        ['Produksi', '18',  'fa-industry',       'purple'],
        ['Selesai',  '115', 'fa-check-double',   'green'],
    ] as $stat)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $stat[0] }}</p>
            <div class="w-8 h-8 bg-{{ $stat[3] }}-100 rounded-lg flex items-center justify-center">
                <i class="fas {{ $stat[2] }} text-{{ $stat[3] }}-600 text-sm"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-gray-900">{{ $stat[1] }}</p>
    </div>
    @endforeach
</div>

{{-- Filter Tabs + Search --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        {{-- Tabs --}}
        <div class="flex flex-wrap gap-1" id="status-tabs">
            @foreach(['Semua' => 'semua', 'Inquiry' => 'inquiry', 'Desain' => 'desain', 'ACC' => 'acc', 'Produksi' => 'produksi', 'Dikirim' => 'dikirim', 'Selesai' => 'selesai'] as $label => $val)
            <button onclick="filterTab('{{ $val }}')"
                    data-tab="{{ $val }}"
                    class="tab-btn px-3 py-1.5 text-xs font-semibold rounded-lg transition-all duration-200 {{ $val === 'semua' ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                {{ $label }}
            </button>
            @endforeach
        </div>
        {{-- Search --}}
        <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 w-full sm:w-56">
            <i class="fas fa-search text-gray-400 text-xs"></i>
            <input type="text" id="order-search" placeholder="Cari order atau pelanggan..."
                   oninput="searchOrders()"
                   class="bg-transparent text-sm text-gray-600 outline-none w-full placeholder-gray-400"
                   aria-label="Cari order">
        </div>
    </div>

    {{-- Table --}}
    @php
    $orders = [
        ['no' => 1, 'id' => 'ORD-2025-001', 'customer' => 'Budi Santoso',   'product' => 'Neon Box',       'size' => '2×1m',  'status' => 'produksi', 'total' => 'Rp 2.450.000', 'date' => '15 Jan 2025'],
        ['no' => 2, 'id' => 'ORD-2025-002', 'customer' => 'Siti Rahayu',    'product' => 'Reklame',        'size' => '3×2m',  'status' => 'desain',   'total' => 'Rp 3.800.000', 'date' => '10 Jan 2025'],
        ['no' => 3, 'id' => 'ORD-2025-003', 'customer' => 'Ahmad Fauzi',    'product' => 'Letter Timbul',  'size' => '50cm',  'status' => 'acc',      'total' => 'Rp 1.200.000', 'date' => '08 Jan 2025'],
        ['no' => 4, 'id' => 'ORD-2025-004', 'customer' => 'Dewi Lestari',   'product' => 'Signage',        'size' => '1×0.5m','status' => 'inquiry',  'total' => 'Rp 850.000',   'date' => '07 Jan 2025'],
        ['no' => 5, 'id' => 'ORD-2025-005', 'customer' => 'Rudi Hartono',   'product' => 'Baliho',         'size' => '4×3m',  'status' => 'dikirim',  'total' => 'Rp 360.000',   'date' => '05 Jan 2025'],
        ['no' => 6, 'id' => 'ORD-2024-098', 'customer' => 'Maya Putri',     'product' => 'Neon Box',       'size' => '3×1m',  'status' => 'selesai',  'total' => 'Rp 2.100.000', 'date' => '28 Des 2024'],
        ['no' => 7, 'id' => 'ORD-2024-097', 'customer' => 'Hendra Wijaya',  'product' => 'Reklame',        'size' => '4×2m',  'status' => 'produksi', 'total' => 'Rp 4.200.000', 'date' => '26 Des 2024'],
        ['no' => 8, 'id' => 'ORD-2024-096', 'customer' => 'Rina Kusuma',    'product' => 'Letter Timbul',  'size' => '80cm',  'status' => 'desain',   'total' => 'Rp 950.000',   'date' => '24 Des 2024'],
    ];
    @endphp

    <div class="overflow-x-auto">
        <table class="w-full text-sm data-table">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ukuran</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 bg-white" id="orders-tbody">
                @foreach($orders as $order)
                <tr class="order-row hover:bg-gray-50 transition-colors"
                    data-status="{{ $order['status'] }}"
                    data-search="{{ strtolower($order['customer'] . ' ' . $order['product'] . ' ' . $order['id']) }}">
                    <td class="px-4 py-3.5 text-gray-500 text-xs">{{ $order['no'] }}</td>
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($order['customer'], 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $order['customer'] }}</p>
                                <p class="text-xs text-gray-400 font-mono">{{ $order['id'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3.5 text-gray-700 font-medium">{{ $order['product'] }}</td>
                    <td class="px-4 py-3.5 text-gray-500 text-xs">{{ $order['size'] }}</td>
                    <td class="px-4 py-3.5"><x-badge status="{{ $order['status'] }}" /></td>
                    <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $order['total'] }}</td>
                    <td class="px-4 py-3.5 text-gray-400 text-xs">{{ $order['date'] }}</td>
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-1.5">
                            <a href="{{ url('/admin/orders/1') }}"
                               class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="fas fa-eye text-[10px]"></i>Detail
                            </a>
                            <button onclick="openModal('modal-update-status')"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>Update
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Empty State --}}
    <div id="orders-empty" class="hidden">
        <x-empty-state icon="fa-clipboard-list" title="Tidak ada order" message="Tidak ada order yang sesuai dengan filter yang dipilih." />
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-xs text-gray-400">Menampilkan 8 dari 156 order</p>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors" aria-label="Halaman sebelumnya">
                <i class="fas fa-chevron-left text-xs"></i>
            </button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-xs font-bold">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs transition-colors">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs transition-colors">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors" aria-label="Halaman berikutnya">
                <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</div>

{{-- Update Status Modal --}}
<x-modal id="modal-update-status" title="Update Status Order" size="md">
    <div class="space-y-4">
        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500 mb-1">Order yang diupdate</p>
            <p class="font-bold text-gray-900">ORD-2025-001 — Budi Santoso</p>
            <p class="text-sm text-gray-500 mt-0.5">Neon Box Akrilik 2×1m</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Baru <span class="text-red-500">*</span></label>
            <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Status baru">
                <option value="inquiry">Inquiry</option>
                <option value="desain">Desain</option>
                <option value="acc">ACC</option>
                <option value="produksi" selected>Produksi</option>
                <option value="dikirim">Dikirim</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan untuk Pelanggan</label>
            <textarea rows="3" placeholder="Contoh: Produksi sedang berjalan, estimasi selesai 3 hari..."
                      class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                      aria-label="Catatan"></textarea>
        </div>
    </div>
    <x-slot name="footer">
        <button onclick="closeModal('modal-update-status')"
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
let activeTab = 'semua';

function filterTab(status) {
    activeTab = status;

    document.querySelectorAll('.tab-btn').forEach(btn => {
        const isActive = btn.dataset.tab === status;
        btn.className = `tab-btn px-3 py-1.5 text-xs font-semibold rounded-lg transition-all duration-200 ${
            isActive ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-100'
        }`;
    });

    applyFilters();
}

function searchOrders() {
    applyFilters();
}

function applyFilters() {
    const searchVal = document.getElementById('order-search').value.toLowerCase();
    const rows = document.querySelectorAll('.order-row');
    let visible = 0;

    rows.forEach(row => {
        const matchStatus = activeTab === 'semua' || row.dataset.status === activeTab;
        const matchSearch = row.dataset.search.includes(searchVal);
        const show = matchStatus && matchSearch;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('orders-empty').classList.toggle('hidden', visible > 0);
}
</script>
@endpush
