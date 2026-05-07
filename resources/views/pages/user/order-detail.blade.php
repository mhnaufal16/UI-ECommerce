@extends('layouts.app')

@section('title', 'Detail Order ORD-2025-001 - AP Kreasi')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ url('/dashboard') }}"
               class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white transition-colors"
               aria-label="Kembali ke dashboard">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <nav class="flex items-center gap-2 text-sm text-slate-400" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ url('/dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white font-medium">ORD-2025-001</span>
            </nav>
        </div>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Detail Order</h1>
            <span class="font-mono text-sm bg-white/10 text-white px-3 py-1 rounded-full">ORD-2025-001</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ===== LEFT: TIMELINE + DETAILS ===== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Status Timeline --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-6">Status Pesanan</h2>

                @php
                $timelineSteps = [
                    ['label' => 'Inquiry',  'icon' => 'fa-question-circle', 'done' => true,   'active' => false],
                    ['label' => 'Desain',   'icon' => 'fa-pencil-ruler',    'done' => true,   'active' => false],
                    ['label' => 'ACC',      'icon' => 'fa-check-circle',    'done' => true,   'active' => false],
                    ['label' => 'Produksi', 'icon' => 'fa-industry',        'done' => false,  'active' => true],
                    ['label' => 'Dikirim',  'icon' => 'fa-truck',           'done' => false,  'active' => false],
                    ['label' => 'Selesai',  'icon' => 'fa-check-double',    'done' => false,  'active' => false],
                ];
                @endphp

                {{-- Desktop Horizontal Timeline --}}
                <div class="hidden sm:flex items-center justify-between mb-6">
                    @foreach($timelineSteps as $i => $step)
                    <div class="flex items-center {{ $i < count($timelineSteps) - 1 ? 'flex-1' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold border-2 transition-all
                                {{ $step['done'] ? 'bg-green-500 border-green-500 text-white' : ($step['active'] ? 'bg-blue-600 border-blue-600 text-white ring-4 ring-blue-100' : 'bg-white border-gray-200 text-gray-400') }}">
                                @if($step['done'])
                                <i class="fas fa-check text-xs"></i>
                                @elseif($step['active'])
                                <i class="fas {{ $step['icon'] }} text-xs"></i>
                                @else
                                <i class="fas {{ $step['icon'] }} text-xs"></i>
                                @endif
                            </div>
                            <span class="text-xs mt-1.5 font-semibold {{ $step['done'] ? 'text-green-600' : ($step['active'] ? 'text-blue-700' : 'text-gray-400') }}">
                                {{ $step['label'] }}
                            </span>
                        </div>
                        @if($i < count($timelineSteps) - 1)
                        <div class="flex-1 h-0.5 mx-2 mb-5 {{ $step['done'] ? 'bg-green-400' : 'bg-gray-200' }}"></div>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- Mobile Vertical Timeline --}}
                <div class="sm:hidden space-y-0 mb-6">
                    @foreach($timelineSteps as $i => $step)
                    <div class="flex gap-4 {{ $i < count($timelineSteps) - 1 ? 'pb-4' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2 flex-shrink-0
                                {{ $step['done'] ? 'bg-green-500 border-green-500 text-white' : ($step['active'] ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-200 text-gray-400') }}">
                                @if($step['done'])
                                <i class="fas fa-check"></i>
                                @else
                                <i class="fas {{ $step['icon'] }}"></i>
                                @endif
                            </div>
                            @if($i < count($timelineSteps) - 1)
                            <div class="w-0.5 flex-1 mt-1 {{ $step['done'] ? 'bg-green-300' : 'bg-gray-200' }}"></div>
                            @endif
                        </div>
                        <div class="pb-1">
                            <p class="text-sm font-semibold {{ $step['done'] ? 'text-green-700' : ($step['active'] ? 'text-blue-700' : 'text-gray-400') }}">
                                {{ $step['label'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Active Step Info --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-industry text-white"></i>
                    </div>
                    <div>
                        <p class="font-bold text-blue-900">Sedang dalam Produksi</p>
                        <p class="text-sm text-blue-700 mt-0.5">Estimasi selesai: <strong>20 Januari 2025</strong></p>
                        <p class="text-xs text-blue-600 mt-1">Tim produksi sedang mengerjakan pesanan Anda dengan penuh perhatian.</p>
                    </div>
                </div>
            </div>

            {{-- ===== TRACKING PENGIRIMAN ===== --}}
            {{-- Hanya tampil jika status = dikirim atau selesai --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="tracking-section">

                {{-- Header --}}
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-truck text-white"></i>
                        </div>
                        <div>
                            <p class="font-bold text-white">Tracking Pengiriman</p>
                            <p class="text-orange-100 text-xs">JNE YES · Estimasi tiba: <strong>Senin, 20 Jan 2025</strong></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-orange-200">No. Resi</p>
                        <p class="font-mono font-bold text-white text-sm tracking-wider">JNE2025011500123</p>
                    </div>
                </div>

                <div class="p-6">

                    {{-- Origin → Destination bar --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex-1 text-center">
                            <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-1.5">
                                <i class="fas fa-warehouse text-blue-600 text-sm"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-800">AP Kreasi</p>
                            <p class="text-xs text-gray-400">Surabaya</p>
                        </div>
                        <div class="flex-1 flex flex-col items-center gap-1">
                            <div class="w-full flex items-center">
                                <div class="flex-1 h-1 bg-orange-400 rounded-l-full"></div>
                                <div class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center shadow-md shadow-orange-200 animate-bounce z-10">
                                    <i class="fas fa-truck text-white text-xs"></i>
                                </div>
                                <div class="flex-1 h-1 bg-gray-200 rounded-r-full"></div>
                            </div>
                            <span class="text-xs font-semibold text-orange-600">Dalam Perjalanan</span>
                        </div>
                        <div class="flex-1 text-center">
                            <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-1.5">
                                <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-800">Budi Santoso</p>
                            <p class="text-xs text-gray-400">Jakarta Selatan</p>
                        </div>
                    </div>

                    {{-- Status terkini --}}
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-3.5 mb-5 flex items-center gap-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-orange-900">Dalam perjalanan ke kota tujuan</p>
                            <p class="text-xs text-orange-700 truncate">Hub JNE Surabaya → Hub JNE Jakarta · <span class="font-medium">2 jam lalu</span></p>
                        </div>
                        <span class="text-xs bg-orange-100 text-orange-600 font-semibold px-2.5 py-1 rounded-full flex-shrink-0">TERKINI</span>
                    </div>

                    {{-- Timeline riwayat --}}
                    <div class="space-y-0" id="tracking-timeline-detail">

                        @php
                        $trackPoints = [
                            ['done' => true,  'current' => true,  'icon' => 'fa-truck',        'color' => 'orange', 'title' => 'Dalam Perjalanan Antar Hub',   'loc' => 'Hub JNE Surabaya → Jakarta',    'time' => '06:45', 'date' => '18 Jan'],
                            ['done' => true,  'current' => false, 'icon' => 'fa-box-open',      'color' => 'blue',   'title' => 'Diterima di Hub Asal',         'loc' => 'Hub JNE Surabaya, Jawa Timur',  'time' => '20:30', 'date' => '17 Jan'],
                            ['done' => true,  'current' => false, 'icon' => 'fa-warehouse',     'color' => 'blue',   'title' => 'Diserahkan ke Kurir',          'loc' => 'Workshop AP Kreasi, Surabaya',  'time' => '15:00', 'date' => '17 Jan'],
                            ['done' => false, 'current' => false, 'icon' => 'fa-building',      'color' => 'gray',   'title' => 'Tiba di Hub Tujuan',           'loc' => 'Hub JNE Jakarta',               'time' => 'Est.',  'date' => '19 Jan'],
                            ['done' => false, 'current' => false, 'icon' => 'fa-motorcycle',    'color' => 'gray',   'title' => 'Pengiriman Terakhir (Last Mile)','loc' => 'Jakarta Selatan',              'time' => 'Est.',  'date' => '20 Jan'],
                            ['done' => false, 'current' => false, 'icon' => 'fa-check-double',  'color' => 'gray',   'title' => 'Paket Diterima',               'loc' => 'Alamat Penerima',               'time' => 'Est.',  'date' => '20 Jan'],
                        ];
                        @endphp

                        @foreach($trackPoints as $i => $pt)
                        <div class="flex gap-3 {{ $i < count($trackPoints) - 1 ? 'pb-4' : '' }}">
                            {{-- Icon + line --}}
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 z-10
                                    {{ $pt['current'] ? 'bg-orange-500 border-orange-500 text-white ring-4 ring-orange-100'
                                        : ($pt['done'] ? 'bg-green-500 border-green-500 text-white'
                                        : 'bg-white border-gray-200 text-gray-300') }}">
                                    @if($pt['done'] && !$pt['current'])
                                        <i class="fas fa-check text-xs"></i>
                                    @else
                                        <i class="fas {{ $pt['icon'] }} text-xs {{ $pt['current'] ? 'animate-pulse' : '' }}"></i>
                                    @endif
                                </div>
                                @if($i < count($trackPoints) - 1)
                                <div class="w-0.5 flex-1 min-h-[1.5rem] mt-1
                                    {{ $pt['done'] ? 'bg-green-200' : 'bg-gray-100' }}"></div>
                                @endif
                            </div>
                            {{-- Content --}}
                            <div class="flex-1 min-w-0 pb-1">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="text-sm font-semibold
                                            {{ $pt['current'] ? 'text-orange-700' : ($pt['done'] ? 'text-gray-900' : 'text-gray-400') }}">
                                            {{ $pt['title'] }}
                                            @if($pt['current'])
                                            <span class="ml-1.5 text-xs bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full font-semibold">TERKINI</span>
                                            @endif
                                        </p>
                                        <p class="text-xs mt-0.5 flex items-center gap-1
                                            {{ $pt['done'] ? 'text-gray-500' : 'text-gray-300' }}">
                                            <i class="fas fa-map-marker-alt text-[10px]"></i>{{ $pt['loc'] }}
                                        </p>
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <p class="text-xs font-semibold {{ $pt['done'] ? 'text-gray-700' : 'text-gray-300' }}">{{ $pt['time'] }}</p>
                                        <p class="text-xs {{ $pt['done'] ? 'text-gray-400' : 'text-gray-300' }}">{{ $pt['date'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Footer actions --}}
                    <div class="mt-5 pt-4 border-t border-gray-100 flex flex-col sm:flex-row gap-2">
                        <a href="{{ url('/dashboard/orders/1/tracking') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-orange-50 hover:bg-orange-100 text-orange-700 font-semibold text-sm rounded-xl transition-colors border border-orange-200">
                            <i class="fas fa-expand-alt text-xs"></i> Lihat Detail Lengkap
                        </a>
                        <a href="https://www.jne.co.id/id/tracking/trace" target="_blank"
                           class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl transition-colors border border-gray-200">
                            <i class="fas fa-external-link-alt text-xs"></i> Cek di Website JNE
                        </a>
                    </div>
                </div>
            </div>

            {{-- Order Specification --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-5">Spesifikasi Order</h2>
                @php
                $specs = [
                    ['ID Order',       'ORD-2025-001',          'fa-hashtag'],
                    ['Tanggal Order',  '15 Januari 2025',       'fa-calendar'],
                    ['Produk',         'Neon Box LED Akrilik',  'fa-lightbulb'],
                    ['Ukuran',         '2m × 1m (2 m²)',        'fa-ruler-combined'],
                    ['Material',       'Akrilik 5mm',           'fa-layer-group'],
                    ['Lampu',          'LED Strip',             'fa-bolt'],
                    ['File Desain',    'desain_neonbox.ai',     'fa-file-alt'],
                    ['Catatan',        'Warna biru dongker, font bold', 'fa-sticky-note'],
                ];
                @endphp
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($specs as $spec)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fas {{ $spec[2] }} text-blue-500 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">{{ $spec[0] }}</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $spec[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Activity Log --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-5">Riwayat Aktivitas</h2>
                @php
                $activities = [
                    ['icon' => 'fa-plus-circle',  'color' => 'blue',   'title' => 'Order dibuat',           'desc' => 'Order ORD-2025-001 berhasil dibuat dan menunggu konfirmasi.',  'date' => '15 Jan 2025, 09:30'],
                    ['icon' => 'fa-pencil-ruler',  'color' => 'purple', 'title' => 'Desain disetujui',       'desc' => 'Desain final telah disetujui oleh pelanggan. Siap produksi.',   'date' => '16 Jan 2025, 14:15'],
                    ['icon' => 'fa-check-circle',  'color' => 'green',  'title' => 'ACC & DP diterima',      'desc' => 'DP 50% sebesar Rp 1.225.000 telah diterima. Produksi dimulai.', 'date' => '17 Jan 2025, 10:00'],
                    ['icon' => 'fa-industry',      'color' => 'orange', 'title' => 'Produksi dimulai',       'desc' => 'Tim produksi mulai mengerjakan pesanan. Estimasi 3-5 hari kerja.','date' => '17 Jan 2025, 11:30'],
                ];
                @endphp
                <div class="space-y-4">
                    @foreach($activities as $i => $act)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 bg-{{ $act['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $act['icon'] }} text-{{ $act['color'] }}-600 text-sm"></i>
                            </div>
                            @if($i < count($activities) - 1)
                            <div class="w-0.5 flex-1 bg-gray-100 mt-2"></div>
                            @endif
                        </div>
                        <div class="pb-4 flex-1">
                            <div class="flex items-center justify-between mb-0.5">
                                <p class="font-semibold text-gray-900 text-sm">{{ $act['title'] }}</p>
                                <span class="text-xs text-gray-400">{{ $act['date'] }}</span>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $act['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== RIGHT: COST + ACTIONS ===== --}}
        <div class="lg:col-span-1 space-y-4">

            {{-- Cost Breakdown --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-6 py-4">
                    <h3 class="font-bold text-white">Rincian Biaya</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3 mb-4">
                        @foreach([
                            ['Material (2m²)', 'Rp 1.600.000'],
                            ['Lampu LED Strip', 'Rp 150.000'],
                            ['Biaya Desain', 'Rp 250.000'],
                            ['Pemasangan', 'Rp 300.000'],
                            ['Ongkir', 'Rp 100.000'],
                        ] as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">{{ $item[0] }}</span>
                            <span class="font-medium text-gray-800">{{ $item[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-100 pt-4 mb-5">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900">Total</span>
                            <span class="font-extrabold text-blue-600 text-xl">Rp 2.400.000</span>
                        </div>
                    </div>

                    {{-- Payment Status --}}
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-sm font-semibold text-green-800">DP Lunas</span>
                            </div>
                            <span class="font-bold text-green-700">Rp 1.200.000</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-amber-50 border border-amber-200 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-amber-500"></i>
                                <span class="text-sm font-semibold text-amber-800">Pelunasan</span>
                            </div>
                            <span class="font-bold text-amber-700">Rp 1.200.000</span>
                        </div>
                    </div>

                    {{-- Tracking Button (shown when status = dikirim) --}}
                    <a href="#tracking-section"
                       onclick="document.getElementById('tracking-section').scrollIntoView({behavior:'smooth'}); return false;"
                       class="block w-full text-center py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-orange-200 mb-3">
                        <i class="fas fa-truck mr-2 animate-pulse"></i>Lacak Pengiriman
                    </a>

                    <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20tanya%20status%20order%20ORD-2025-001"
                       target="_blank"
                       class="block w-full text-center py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors mb-3">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi via WhatsApp
                    </a>
                    <a href="{{ url('/dashboard') }}"
                       class="block w-full text-center py-3 border-2 border-gray-200 hover:border-blue-300 text-gray-600 hover:text-blue-600 font-semibold rounded-xl transition-all">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
