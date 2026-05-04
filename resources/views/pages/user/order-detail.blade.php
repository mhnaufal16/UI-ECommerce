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
