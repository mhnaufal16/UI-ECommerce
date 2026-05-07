@extends('layouts.app')

@section('title', 'Dashboard - AP Kreasi')

@section('content')

<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-extrabold text-white">Dashboard Saya</h1>
        <p class="text-slate-300 text-sm mt-1">Selamat datang kembali, Budi Santoso!</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid lg:grid-cols-4 gap-6">

        {{-- ===== LEFT SIDEBAR ===== --}}
        <div class="lg:col-span-1 space-y-4">
            {{-- Profile Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-3 text-white text-xl font-extrabold shadow-lg">
                    BS
                </div>
                <h3 class="font-bold text-gray-900 text-base">Budi Santoso</h3>
                <p class="text-xs text-gray-400 mt-0.5">budi.santoso@email.com</p>
                <div class="flex justify-center gap-6 mt-4 pt-4 border-t border-gray-100">
                    <div class="text-center">
                        <p class="font-bold text-gray-900 text-lg">5</p>
                        <p class="text-xs text-gray-400">Total Order</p>
                    </div>
                    <div class="w-px bg-gray-100"></div>
                    <div class="text-center">
                        <p class="font-bold text-green-600 text-lg">3</p>
                        <p class="text-xs text-gray-400">Selesai</p>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @php
                $navItems = [
                    ['icon' => 'fa-clipboard-list', 'label' => 'Riwayat Order',  'active' => true,  'badge' => null],
                    ['icon' => 'fa-user',            'label' => 'Profil Saya',    'active' => false, 'badge' => null],
                    ['icon' => 'fa-plus-circle',     'label' => 'Buat Order Baru','active' => false, 'badge' => null, 'href' => '/kalkulator'],
                    ['icon' => 'fa-bell',            'label' => 'Notifikasi',     'active' => false, 'badge' => '2'],
                    ['icon' => 'fa-sign-out-alt',    'label' => 'Keluar',         'active' => false, 'badge' => null, 'danger' => true],
                ];
                @endphp
                @foreach($navItems as $nav)
                <a href="{{ isset($nav['href']) ? url($nav['href']) : '#' }}"
                   class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium transition-colors border-b border-gray-50 last:border-0
                       {{ $nav['active'] ? 'bg-blue-50 text-blue-700' : (isset($nav['danger']) ? 'text-red-500 hover:bg-red-50' : 'text-gray-600 hover:bg-gray-50') }}">
                    <i class="fas {{ $nav['icon'] }} w-4 text-center {{ $nav['active'] ? 'text-blue-600' : (isset($nav['danger']) ? 'text-red-400' : 'text-gray-400') }}"></i>
                    <span class="flex-1">{{ $nav['label'] }}</span>
                    @if($nav['badge'])
                    <span class="bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full font-bold">{{ $nav['badge'] }}</span>
                    @endif
                    @if($nav['active'])
                    <i class="fas fa-chevron-right text-blue-400 text-xs"></i>
                    @endif
                </a>
                @endforeach
            </div>
        </div>

        {{-- ===== RIGHT CONTENT ===== --}}
        <div class="lg:col-span-3 space-y-6">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Riwayat Order</h2>
                <a href="{{ url('/kalkulator') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                    <i class="fas fa-plus text-xs"></i> Order Baru
                </a>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    ['Total Order', '5', 'fa-clipboard-list', 'blue'],
                    ['Diproses', '2', 'fa-industry', 'purple'],
                    ['Selesai', '3', 'fa-check-double', 'green'],
                    ['Total Belanja', 'Rp 8,2jt', 'fa-wallet', 'yellow'],
                ] as $stat)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $stat[0] }}</p>
                        <div class="w-8 h-8 bg-{{ $stat[3] }}-100 rounded-lg flex items-center justify-center">
                            <i class="fas {{ $stat[2] }} text-{{ $stat[3] }}-600 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-xl font-extrabold text-gray-900">{{ $stat[1] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Filter & Table --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <h3 class="font-bold text-gray-900">Daftar Order</h3>
                    <select id="status-filter" onchange="filterOrders()"
                            class="text-sm border border-gray-200 rounded-xl px-3 py-2 outline-none focus:border-blue-400 bg-white text-gray-600"
                            aria-label="Filter status">
                        <option value="semua">Semua Status</option>
                        <option value="produksi">Produksi</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                {{-- Desktop Table --}}
                @php
                $orders = [
                    ['id' => 'ORD-2025-001', 'product' => 'Neon Box Akrilik 2×1m',       'date' => '15 Jan 2025', 'status' => 'produksi', 'total' => 'Rp 2.450.000'],
                    ['id' => 'ORD-2025-002', 'product' => 'Reklame Galvanis 3×2m',        'date' => '10 Jan 2025', 'status' => 'dikirim',  'total' => 'Rp 3.800.000'],
                    ['id' => 'ORD-2024-089', 'product' => 'Letter Timbul Stainless',       'date' => '28 Des 2024', 'status' => 'selesai',  'total' => 'Rp 1.200.000'],
                    ['id' => 'ORD-2024-076', 'product' => 'Signage Kantor Premium',        'date' => '15 Des 2024', 'status' => 'selesai',  'total' => 'Rp 850.000'],
                    ['id' => 'ORD-2024-055', 'product' => 'Baliho Event 4×3m',            'date' => '01 Des 2024', 'status' => 'selesai',  'total' => 'Rp 360.000'],
                ];
                @endphp

                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Order</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50" id="orders-table-body">
                            @foreach($orders as $order)
                            <tr class="order-row hover:bg-gray-50 transition-colors" data-status="{{ $order['status'] }}">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-blue-600">{{ $order['id'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ $order['product'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $order['date'] }}</td>
                                <td class="px-6 py-4">
                                    <x-badge status="{{ $order['status'] }}" />
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $order['total'] }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ url('/dashboard/orders/1') }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                        <i class="fas fa-eye text-[10px]"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View --}}
                <div class="sm:hidden divide-y divide-gray-100" id="orders-mobile-body">
                    @foreach($orders as $order)
                    <div class="order-card p-4" data-status="{{ $order['status'] }}">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <span class="font-mono text-xs font-bold text-blue-600">{{ $order['id'] }}</span>
                                <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $order['product'] }}</p>
                            </div>
                            <x-badge status="{{ $order['status'] }}" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-400">{{ $order['date'] }}</p>
                                <p class="font-bold text-gray-900 text-sm mt-0.5">{{ $order['total'] }}</p>
                            </div>
                            <a href="{{ url('/dashboard/orders/1') }}" class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function filterOrders() {
    const filter = document.getElementById('status-filter').value;

    // Desktop rows
    document.querySelectorAll('.order-row').forEach(row => {
        row.style.display = (filter === 'semua' || row.dataset.status === filter) ? '' : 'none';
    });

    // Mobile cards
    document.querySelectorAll('.order-card').forEach(card => {
        card.style.display = (filter === 'semua' || card.dataset.status === filter) ? '' : 'none';
    });
}
</script>
@endpush
