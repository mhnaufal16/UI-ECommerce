@extends('layouts.admin')

@section('title', 'Detail Order #ORD-2025-001 - Admin')
@section('page-title', 'Detail Order #ORD-2025-001')
@section('page-subtitle', 'Informasi lengkap dan manajemen order')

@section('content')

{{-- Back Button --}}
<div class="mb-5">
    <a href="{{ url('/admin/orders') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-blue-600 bg-white border border-gray-200 hover:border-blue-300 px-4 py-2 rounded-xl transition-all">
        <i class="fas fa-arrow-left text-xs"></i> Kembali ke Daftar Order
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- ===== LEFT ===== --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Customer Info --}}
        <x-card title="Informasi Pelanggan">
            @php
            $customerInfo = [
                ['Nama Lengkap', 'Budi Santoso',              'fa-user'],
                ['WhatsApp',     '+62 812-3456-7890',          'fa-whatsapp'],
                ['Email',        'budi.santoso@email.com',     'fa-envelope'],
                ['Kota',         'Surabaya',                   'fa-map-marker-alt'],
                ['Alamat',       'Jl. Raya Darmo No. 45, Surabaya Pusat', 'fa-map'],
            ];
            @endphp
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach($customerInfo as $info)
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas {{ $info[2] }} text-blue-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium">{{ $info[0] }}</p>
                        <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $info[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </x-card>

        {{-- Order Specification --}}
        <x-card title="Spesifikasi Order">
            @php
            $specs = [
                ['Produk',        'Neon Box LED Akrilik',  'fa-lightbulb'],
                ['Ukuran',        '2m × 1m (2 m²)',        'fa-ruler-combined'],
                ['Material',      'Akrilik 5mm',           'fa-layer-group'],
                ['Lampu',         'LED Strip',             'fa-bolt'],
                ['Tanggal Order', '15 Januari 2025',       'fa-calendar'],
                ['Catatan',       'Warna biru dongker, font bold', 'fa-sticky-note'],
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
        </x-card>

        {{-- Design File --}}
        <x-card title="File Desain">
            {{-- Current File --}}
            <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-xl mb-5">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-file-alt text-green-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-green-800 text-sm">desain_neonbox_final.ai</p>
                    <p class="text-xs text-green-600 mt-0.5">Diupload: 16 Jan 2025 • 2.4 MB</p>
                </div>
                <a href="#" class="text-xs font-semibold text-green-700 bg-green-100 hover:bg-green-200 px-3 py-1.5 rounded-lg transition-colors">
                    <i class="fas fa-download mr-1"></i>Unduh
                </a>
            </div>

            {{-- Upload New --}}
            <div>
                <p class="text-sm font-semibold text-gray-700 mb-3">Upload Revisi Desain</p>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 hover:bg-blue-50/50 transition-all cursor-pointer"
                     onclick="document.getElementById('admin-file-input').click()">
                    <i class="fas fa-cloud-upload-alt text-gray-300 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-500">Klik atau drag file desain baru</p>
                    <p class="text-xs text-gray-400 mt-1">AI, PDF, PNG, JPG (maks. 20MB)</p>
                    <input type="file" id="admin-file-input" class="hidden" accept=".ai,.pdf,.png,.jpg,.jpeg">
                </div>
            </div>
        </x-card>

        {{-- Extra Cost --}}
        <x-card title="Biaya Tambahan">
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nominal Biaya Tambahan</label>
                    <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                        <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">Rp</span>
                        <input type="number" placeholder="0" min="0"
                               class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                               aria-label="Biaya tambahan">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                    <input type="text" placeholder="Contoh: Biaya revisi desain..."
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                           aria-label="Keterangan biaya tambahan">
                </div>
            </div>
            <div class="mt-4">
                <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    <i class="fas fa-plus mr-1.5"></i>Tambahkan Biaya
                </button>
            </div>
        </x-card>
    </div>

    {{-- ===== RIGHT ===== --}}
    <div class="lg:col-span-1 space-y-5">

        {{-- Status Update --}}
        <x-card title="Update Status">
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500 mb-2">Status Saat Ini</p>
                    <x-badge status="produksi" size="lg" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ubah Status</label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Ubah status">
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
                    <textarea rows="3" placeholder="Catatan untuk pelanggan..."
                              class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                              aria-label="Catatan status"></textarea>
                </div>
                <button class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    <i class="fas fa-save mr-1.5"></i>Simpan Perubahan
                </button>
            </div>
        </x-card>

        {{-- Cost Breakdown --}}
        <x-card title="Rincian Biaya">
            <div class="space-y-3 mb-4">
                @foreach([
                    ['Material (2m²)', 'Rp 1.600.000'],
                    ['Lampu LED Strip', 'Rp 150.000'],
                    ['Biaya Desain',    'Rp 250.000'],
                    ['Pemasangan',      'Rp 300.000'],
                    ['Ongkir',          'Rp 100.000'],
                ] as $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">{{ $item[0] }}</span>
                    <span class="font-medium text-gray-800">{{ $item[1] }}</span>
                </div>
                @endforeach
            </div>
            <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                <span class="font-bold text-gray-900">Total</span>
                <span class="font-extrabold text-blue-600 text-lg">Rp 2.400.000</span>
            </div>
        </x-card>

        {{-- Timeline Mini --}}
        <x-card title="Timeline Order">
            @php
            $timelineSteps = [
                ['label' => 'Inquiry',  'done' => true,  'active' => false],
                ['label' => 'Desain',   'done' => true,  'active' => false],
                ['label' => 'ACC',      'done' => true,  'active' => false],
                ['label' => 'Produksi', 'done' => false, 'active' => true],
                ['label' => 'Dikirim',  'done' => false, 'active' => false],
                ['label' => 'Selesai',  'done' => false, 'active' => false],
            ];
            @endphp
            <div class="flex items-center justify-between">
                @foreach($timelineSteps as $i => $step)
                <div class="flex items-center {{ $i < count($timelineSteps) - 1 ? 'flex-1' : '' }}">
                    <div class="flex flex-col items-center">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold border-2
                            {{ $step['done'] ? 'bg-green-500 border-green-500 text-white' : ($step['active'] ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-200 text-gray-400') }}">
                            @if($step['done'])
                            <i class="fas fa-check text-[9px]"></i>
                            @else
                            {{ $i + 1 }}
                            @endif
                        </div>
                        <span class="text-[9px] mt-1 font-semibold {{ $step['done'] ? 'text-green-600' : ($step['active'] ? 'text-blue-700' : 'text-gray-400') }}">
                            {{ $step['label'] }}
                        </span>
                    </div>
                    @if($i < count($timelineSteps) - 1)
                    <div class="flex-1 h-0.5 mx-1 mb-4 {{ $step['done'] ? 'bg-green-400' : 'bg-gray-200' }}"></div>
                    @endif
                </div>
                @endforeach
            </div>
        </x-card>

        {{-- WhatsApp Button --}}
        <a href="https://wa.me/6281234567890?text=Halo%20Budi%2C%20ini%20dari%20AP%20Kreasi%20mengenai%20order%20ORD-2025-001"
           target="_blank"
           class="flex items-center justify-center gap-2 w-full py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors shadow-sm">
            <i class="fab fa-whatsapp text-lg"></i> Hubungi Pelanggan
        </a>

        {{-- Tracking Button --}}
        <a href="{{ url('/admin/shipping') }}"
           class="flex items-center justify-center gap-2 w-full py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl transition-colors shadow-sm">
            <i class="fas fa-truck text-lg"></i> Manajemen Pengiriman
        </a>
    </div>
</div>

@endsection
