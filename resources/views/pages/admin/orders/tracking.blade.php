@extends('layouts.admin')

@section('title', 'Manajemen Pengiriman - Admin')
@section('page-title', 'Manajemen Pengiriman')
@section('page-subtitle', 'Kelola dan update status pengiriman semua order')

@section('content')

{{-- Summary Stats --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['Semua Pengiriman', '34',  'fa-truck',         'blue',   'Total aktif'],
        ['Diproses',         '8',   'fa-box',           'purple', 'Menunggu pickup'],
        ['Dalam Perjalanan', '18',  'fa-shipping-fast', 'orange', 'Sedang dikirim'],
        ['Terkirim Hari Ini','8',   'fa-check-circle',  'green',  'Sudah diterima'],
    ] as $stat)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider leading-tight">{{ $stat[0] }}</p>
            <div class="w-9 h-9 bg-{{ $stat[3] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas {{ $stat[2] }} text-{{ $stat[3] }}-600 text-sm"></i>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stat[1] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $stat[4] }}</p>
    </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- ===== LEFT: SHIPMENT LIST ===== --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Filter + Search --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex flex-wrap gap-1.5" id="ship-tabs">
                    @foreach(['Semua' => 'semua', 'Diproses' => 'diproses', 'Pickup' => 'pickup', 'Dalam Perjalanan' => 'transit', 'Terkirim' => 'delivered', 'Bermasalah' => 'problem'] as $label => $val)
                    <button onclick="filterShipTab('{{ $val }}')" data-tab="{{ $val }}"
                            class="ship-tab-btn px-3 py-1.5 text-xs font-semibold rounded-lg transition-all duration-200 {{ $val === 'semua' ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                        {{ $label }}
                        @if($val === 'problem')
                        <span class="ml-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">2</span>
                        @endif
                    </button>
                    @endforeach
                </div>
                <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 w-full sm:w-56">
                    <i class="fas fa-search text-gray-400 text-xs"></i>
                    <input type="text" id="ship-search" placeholder="Cari order / resi..."
                           oninput="searchShipments()"
                           class="bg-transparent text-sm text-gray-600 outline-none w-full placeholder-gray-400"
                           aria-label="Cari pengiriman">
                </div>
            </div>

            {{-- Shipment Rows --}}
            @php
            $shipments = [
                ['id' => 'ORD-2025-005', 'customer' => 'Rudi Hartono',  'product' => 'Baliho Flexi 4×3m',      'courier' => 'JNE YES',    'resi' => 'JNE2025011500123', 'status' => 'transit',   'location' => 'Hub JNE Surabaya → Jakarta', 'date' => '17 Jan 2025', 'eta' => '20 Jan 2025'],
                ['id' => 'ORD-2025-008', 'customer' => 'Andi Prasetyo', 'product' => 'Neon Box LED 3×1m',     'courier' => 'SiCepat',    'resi' => 'SCP20250118456',   'status' => 'transit',   'location' => 'Hub SiCepat Surabaya',       'date' => '18 Jan 2025', 'eta' => '21 Jan 2025'],
                ['id' => 'ORD-2025-009', 'customer' => 'Lina Susanti',  'product' => 'Signage Direktori',      'courier' => 'J&T Express','resi' => 'JT2025011800789',  'status' => 'diproses',  'location' => 'Workshop AP Kreasi',         'date' => '18 Jan 2025', 'eta' => '22 Jan 2025'],
                ['id' => 'ORD-2025-010', 'customer' => 'Bowo Santoso',  'product' => 'Reklame Akrilik 2×1m',  'courier' => 'AnterAja',   'resi' => 'AJ20250118321',    'status' => 'pickup',    'location' => 'Menunggu Pickup Kurir',      'date' => '18 Jan 2025', 'eta' => '22 Jan 2025'],
                ['id' => 'ORD-2025-003', 'customer' => 'Ahmad Fauzi',   'product' => 'Letter Timbul 50cm',     'courier' => 'JNE Regular','resi' => 'JNE2025011200456', 'status' => 'delivered', 'location' => 'Diterima Penerima',          'date' => '12 Jan 2025', 'eta' => '15 Jan 2025'],
                ['id' => 'ORD-2025-007', 'customer' => 'Hendra Wijaya', 'product' => 'Reklame Stainless 4×2m','courier' => 'JNE YES',    'resi' => 'JNE2025011600789', 'status' => 'problem',   'location' => 'Gagal Antar — Alamat Tidak Ditemukan', 'date' => '16 Jan 2025', 'eta' => '19 Jan 2025'],
                ['id' => 'ORD-2025-011', 'customer' => 'Dewi Kartika',  'product' => 'Neon Box Galvanis 2×1m','courier' => 'SiCepat',    'resi' => '-',                'status' => 'diproses',  'location' => 'Sedang Dikemas',             'date' => '19 Jan 2025', 'eta' => '23 Jan 2025'],
            ];
            $statusConfig = [
                'diproses'  => ['label' => 'Diproses',          'color' => 'purple', 'icon' => 'fa-box'],
                'pickup'    => ['label' => 'Menunggu Pickup',   'color' => 'yellow', 'icon' => 'fa-clock'],
                'transit'   => ['label' => 'Dalam Perjalanan',  'color' => 'orange', 'icon' => 'fa-truck'],
                'delivered' => ['label' => 'Terkirim',          'color' => 'green',  'icon' => 'fa-check-circle'],
                'problem'   => ['label' => 'Bermasalah',        'color' => 'red',    'icon' => 'fa-exclamation-triangle'],
            ];
            @endphp

            <div id="shipment-list" class="divide-y divide-gray-50">
                @foreach($shipments as $ship)
                @php $cfg = $statusConfig[$ship['status']]; @endphp
                <div class="shipment-row px-5 py-4 hover:bg-gray-50 transition-colors cursor-pointer"
                     data-tab="{{ $ship['status'] }}"
                     data-search="{{ strtolower($ship['id'] . ' ' . $ship['customer'] . ' ' . $ship['resi']) }}"
                     onclick="selectShipment('{{ $ship['id'] }}')">
                    <div class="flex items-start gap-3">
                        {{-- Status Icon --}}
                        <div class="w-10 h-10 bg-{{ $cfg['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas {{ $cfg['icon'] }} text-{{ $cfg['color'] }}-600 text-sm {{ $ship['status'] === 'transit' ? 'animate-pulse' : '' }}"></i>
                        </div>
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 flex-wrap">
                                <div>
                                    <span class="font-bold text-gray-900 text-sm">{{ $ship['customer'] }}</span>
                                    <span class="text-xs text-gray-400 font-mono ml-2">{{ $ship['id'] }}</span>
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                    bg-{{ $cfg['color'] }}-100 text-{{ $cfg['color'] }}-700">
                                    {{ $cfg['label'] }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 mt-0.5">{{ $ship['product'] }}</p>
                            <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-truck text-gray-400"></i>{{ $ship['courier'] }}
                                </span>
                                @if($ship['resi'] !== '-')
                                <span class="text-xs font-mono text-blue-600 bg-blue-50 px-2 py-0.5 rounded">{{ $ship['resi'] }}</span>
                                @else
                                <span class="text-xs text-gray-400 italic">Resi belum diinput</span>
                                @endif
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>{{ $ship['location'] }}
                                </span>
                            </div>
                        </div>
                        {{-- ETA --}}
                        <div class="text-right flex-shrink-0 hidden sm:block">
                            <p class="text-xs text-gray-400">ETA</p>
                            <p class="text-xs font-semibold text-gray-700">{{ $ship['eta'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            <div id="ship-empty" class="hidden py-12 text-center">
                <i class="fas fa-truck text-gray-200 text-4xl mb-3"></i>
                <p class="text-gray-400 font-medium">Tidak ada pengiriman ditemukan</p>
            </div>
        </div>
    </div>

    {{-- ===== RIGHT: INPUT & UPDATE PANEL ===== --}}
    <div class="lg:col-span-1 space-y-5">

        {{-- Input Resi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-barcode text-blue-500"></i> Input Data Pengiriman
            </h3>
            <form onsubmit="saveShippingData(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Order ID <span class="text-red-500">*</span></label>
                    <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Order ID">
                        <option value="">Pilih Order...</option>
                        <option value="ORD-2025-009">ORD-2025-009 — Lina Susanti</option>
                        <option value="ORD-2025-010">ORD-2025-010 — Bowo Santoso</option>
                        <option value="ORD-2025-011">ORD-2025-011 — Dewi Kartika</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Ekspedisi <span class="text-red-500">*</span></label>
                    <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Ekspedisi">
                        <option value="">Pilih Ekspedisi...</option>
                        <option>JNE Regular</option>
                        <option>JNE YES</option>
                        <option>J&T Express</option>
                        <option>SiCepat Halu</option>
                        <option>AnterAja</option>
                        <option>Ambil Sendiri</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nomor Resi <span class="text-red-500">*</span></label>
                    <input type="text" placeholder="Contoh: JNE2025011500123"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 font-mono"
                           aria-label="Nomor resi">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tanggal Kirim</label>
                        <input type="date" class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400" aria-label="Tanggal kirim">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Estimasi Tiba</label>
                        <input type="date" class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400" aria-label="Estimasi tiba">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Berat Paket (kg)</label>
                    <input type="number" placeholder="0" min="0" step="0.1"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400"
                           aria-label="Berat paket">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Catatan Pengiriman</label>
                    <textarea rows="2" placeholder="Catatan khusus untuk pengiriman..."
                              class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                              aria-label="Catatan pengiriman"></textarea>
                </div>
                <button type="submit"
                        class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-colors">
                    <i class="fas fa-save mr-1.5"></i>Simpan & Kirim Notifikasi
                </button>
            </form>
        </div>

        {{-- Update Tracking --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-map-pin text-orange-500"></i> Update Posisi Paket
            </h3>
            <form onsubmit="addTrackingPoint(event)" class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Order / Resi</label>
                    <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Pilih order">
                        <option>ORD-2025-005 — JNE2025011500123</option>
                        <option>ORD-2025-008 — SCP20250118456</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Status Terbaru <span class="text-red-500">*</span></label>
                    <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Status terbaru">
                        <option value="pickup">Pickup oleh Kurir</option>
                        <option value="hub_asal">Tiba di Hub Asal</option>
                        <option value="transit" selected>Dalam Perjalanan Antar Hub</option>
                        <option value="hub_tujuan">Tiba di Hub Tujuan</option>
                        <option value="out_delivery">Dalam Pengiriman Terakhir</option>
                        <option value="delivered">Terkirim ke Penerima</option>
                        <option value="failed">Gagal Antar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Lokasi Saat Ini <span class="text-red-500">*</span></label>
                    <input type="text" placeholder="Contoh: Hub JNE Jakarta Selatan"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400"
                           aria-label="Lokasi saat ini">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Keterangan</label>
                    <textarea rows="2" placeholder="Detail update posisi paket..."
                              class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                              aria-label="Keterangan"></textarea>
                </div>
                <button type="submit"
                        class="w-full py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold rounded-xl transition-colors">
                    <i class="fas fa-map-pin mr-1.5"></i>Tambah Update Posisi
                </button>
            </form>
        </div>

        {{-- Problem Handler --}}
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
            <h3 class="font-bold text-red-800 mb-3 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-red-500"></i> Pengiriman Bermasalah
            </h3>
            <div class="space-y-3 mb-4">
                <div class="bg-white rounded-xl p-3 border border-red-100">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-sm font-bold text-gray-900">ORD-2025-007</p>
                            <p class="text-xs text-gray-500">Hendra Wijaya — JNE YES</p>
                            <p class="text-xs text-red-600 mt-1 font-medium">
                                <i class="fas fa-times-circle mr-1"></i>Gagal Antar — Alamat Tidak Ditemukan
                            </p>
                        </div>
                        <button onclick="openModal('modal-resolve-problem')"
                                class="text-xs font-semibold text-red-600 bg-red-100 hover:bg-red-200 px-3 py-1.5 rounded-lg transition-colors flex-shrink-0">
                            Tangani
                        </button>
                    </div>
                </div>
            </div>
            <p class="text-xs text-red-600">1 pengiriman membutuhkan penanganan segera.</p>
        </div>
    </div>
</div>

{{-- Resolve Problem Modal --}}
<x-modal id="modal-resolve-problem" title="Tangani Masalah Pengiriman" size="md">
    <div class="space-y-4">
        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="text-xs text-gray-500 mb-1">Order bermasalah</p>
            <p class="font-bold text-gray-900">ORD-2025-007 — Hendra Wijaya</p>
            <p class="text-sm text-red-600 mt-1 font-medium"><i class="fas fa-times-circle mr-1"></i>Gagal Antar — Alamat Tidak Ditemukan</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tindakan <span class="text-red-500">*</span></label>
            <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 bg-white" aria-label="Tindakan">
                <option>Jadwalkan ulang pengiriman</option>
                <option>Hubungi penerima untuk konfirmasi alamat</option>
                <option>Kembalikan ke pengirim (RTS)</option>
                <option>Kirim ulang dengan ekspedisi lain</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan Penanganan</label>
            <textarea rows="3" placeholder="Jelaskan tindakan yang diambil..."
                      class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 resize-none"
                      aria-label="Catatan penanganan"></textarea>
        </div>
        <div class="flex items-center gap-2 p-3 bg-amber-50 border border-amber-200 rounded-xl">
            <input type="checkbox" id="notify-customer" class="accent-blue-600">
            <label for="notify-customer" class="text-sm text-amber-800 cursor-pointer">Kirim notifikasi WhatsApp ke pelanggan</label>
        </div>
    </div>
    <x-slot name="footer">
        <button onclick="closeModal('modal-resolve-problem')"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button onclick="resolveProblem()"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors">
            <i class="fas fa-check mr-1.5"></i>Tandai Ditangani
        </button>
    </x-slot>
</x-modal>

@endsection

@push('scripts')
<script>
let activeShipTab = 'semua';

function filterShipTab(tab) {
    activeShipTab = tab;
    document.querySelectorAll('.ship-tab-btn').forEach(btn => {
        const isActive = btn.dataset.tab === tab;
        btn.className = `ship-tab-btn px-3 py-1.5 text-xs font-semibold rounded-lg transition-all duration-200 ${
            isActive ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-100'
        }`;
    });
    applyShipFilters();
}

function searchShipments() { applyShipFilters(); }

function applyShipFilters() {
    const searchVal = document.getElementById('ship-search').value.toLowerCase();
    const rows = document.querySelectorAll('.shipment-row');
    let visible = 0;
    rows.forEach(row => {
        const matchTab = activeShipTab === 'semua' || row.dataset.tab === activeShipTab;
        const matchSearch = row.dataset.search.includes(searchVal);
        const show = matchTab && matchSearch;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('ship-empty').classList.toggle('hidden', visible > 0);
}

function selectShipment(id) {
    document.querySelectorAll('.shipment-row').forEach(r => r.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500'));
    const selected = document.querySelector(`.shipment-row[onclick="selectShipment('${id}')"]`);
    if (selected) selected.classList.add('bg-blue-50', 'border-l-4', 'border-blue-500');
}

function saveShippingData(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i>Menyimpan...';
    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check mr-1.5"></i>Tersimpan!';
        btn.className = btn.className.replace('bg-blue-600 hover:bg-blue-700', 'bg-green-600');
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-save mr-1.5"></i>Simpan & Kirim Notifikasi';
            btn.className = btn.className.replace('bg-green-600', 'bg-blue-600 hover:bg-blue-700');
            btn.disabled = false;
        }, 2000);
    }, 1200);
}

function addTrackingPoint(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i>Menambahkan...';
    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check mr-1.5"></i>Update Ditambahkan!';
        btn.className = btn.className.replace('bg-orange-500 hover:bg-orange-600', 'bg-green-600');
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-map-pin mr-1.5"></i>Tambah Update Posisi';
            btn.className = btn.className.replace('bg-green-600', 'bg-orange-500 hover:bg-orange-600');
            btn.disabled = false;
        }, 2000);
    }, 1000);
}

function resolveProblem() {
    closeModal('modal-resolve-problem');
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 z-50';
    toast.innerHTML = '<i class="fas fa-check-circle text-xl"></i><div><p class="font-bold">Masalah Ditangani</p><p class="text-sm text-green-200">Notifikasi telah dikirim ke pelanggan.</p></div>';
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3500);
}
</script>
@endpush
