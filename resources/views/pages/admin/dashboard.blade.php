@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, Admin Utama')

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
    <x-stat-card
        title="Total Order"
        value="156"
        icon="fa-clipboard-list"
        color="blue"
        change="+12% vs bulan lalu"
        changeType="up"
    />
    <x-stat-card
        title="Order Pending"
        value="23"
        icon="fa-clock"
        color="yellow"
        change="+5 order baru"
        changeType="up"
    />
    <x-stat-card
        title="Omzet Bulan Ini"
        value="Rp 48,5jt"
        icon="fa-wallet"
        color="green"
        change="+18%"
        changeType="up"
    />
    <x-stat-card
        title="Produk Aktif"
        value="8"
        icon="fa-box"
        color="purple"
    />
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">

    {{-- Recent Orders --}}
    <div class="lg:col-span-2">
        <x-card title="Order Terbaru" subtitle="5 order terakhir masuk">
            <x-slot name="action">
                <a href="{{ url('/admin/orders') }}" class="text-xs text-blue-600 font-semibold hover:underline">Lihat Semua</a>
            </x-slot>

            @php
            $recentOrders = [
                ['customer' => 'Budi Santoso',   'product' => 'Neon Box 2×1m',       'status' => 'produksi', 'total' => 'Rp 2.450.000'],
                ['customer' => 'Siti Rahayu',    'product' => 'Reklame Akrilik 3×2m', 'status' => 'desain',   'total' => 'Rp 3.800.000'],
                ['customer' => 'Ahmad Fauzi',    'product' => 'Letter Timbul',         'status' => 'acc',      'total' => 'Rp 1.200.000'],
                ['customer' => 'Dewi Lestari',   'product' => 'Signage Kantor',        'status' => 'inquiry',  'total' => 'Rp 850.000'],
                ['customer' => 'Rudi Hartono',   'product' => 'Baliho 4×3m',          'status' => 'dikirim',  'total' => 'Rp 360.000'],
            ];
            @endphp

            <div class="overflow-x-auto -mx-6 -mb-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-y border-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentOrders as $i => $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($order['customer'], 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-900 text-sm">{{ $order['customer'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-gray-600 text-sm">{{ $order['product'] }}</td>
                            <td class="px-6 py-3.5"><x-badge status="{{ $order['status'] }}" /></td>
                            <td class="px-6 py-3.5 font-semibold text-gray-900 text-sm">{{ $order['total'] }}</td>
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ url('/admin/orders/1') }}"
                                       class="text-xs font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    <button onclick="openModal('modal-update-status')"
                                            class="text-xs font-semibold text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <i class="fas fa-edit mr-1"></i>Update
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

    {{-- Quick Actions + Chart --}}
    <div class="space-y-5">
        {{-- Quick Actions --}}
        <x-card title="Aksi Cepat">
            @php
            $quickActions = [
                ['icon' => 'fa-plus-circle', 'label' => 'Tambah Produk',    'color' => 'blue',   'href' => '/admin/products'],
                ['icon' => 'fa-tag',         'label' => 'Buat Promo',       'color' => 'green',  'href' => '/admin/promos'],
                ['icon' => 'fa-sliders-h',   'label' => 'Pengaturan Harga', 'color' => 'purple', 'href' => '/admin/pricing'],
                ['icon' => 'fa-chart-bar',   'label' => 'Laporan',          'color' => 'orange', 'href' => '#'],
            ];
            @endphp
            <div class="grid grid-cols-2 gap-3">
                @foreach($quickActions as $action)
                <a href="{{ url($action['href']) }}"
                   class="flex flex-col items-center gap-2 p-4 bg-{{ $action['color'] }}-50 hover:bg-{{ $action['color'] }}-100 border border-{{ $action['color'] }}-100 rounded-xl transition-colors group">
                    <div class="w-10 h-10 bg-{{ $action['color'] }}-100 group-hover:bg-{{ $action['color'] }}-200 rounded-xl flex items-center justify-center transition-colors">
                        <i class="fas {{ $action['icon'] }} text-{{ $action['color'] }}-600"></i>
                    </div>
                    <span class="text-xs font-semibold text-{{ $action['color'] }}-700 text-center">{{ $action['label'] }}</span>
                </a>
                @endforeach
            </div>
        </x-card>

        {{-- Chart Placeholder --}}
        <x-card title="Grafik Omzet" subtitle="30 hari terakhir">
            <div class="h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex flex-col items-center justify-center gap-2">
                <i class="fas fa-chart-line text-white/50 text-3xl"></i>
                <p class="text-white/70 text-sm font-medium">Grafik Omzet</p>
                <p class="text-white/50 text-xs">Chart akan ditampilkan di sini</p>
            </div>
        </x-card>
    </div>
</div>

{{-- Update Status Modal --}}
<x-modal id="modal-update-status" title="Update Status Order" size="md">
    <div class="space-y-4">
        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500 mb-1">Order</p>
            <p class="font-bold text-gray-900">ORD-2025-001 — Budi Santoso</p>
            <p class="text-sm text-gray-500">Neon Box Akrilik 2×1m</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Baru</label>
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
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan</label>
            <textarea rows="3" placeholder="Catatan untuk pelanggan (opsional)..."
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
