@extends('layouts.app')

@section('title', 'Tracking Pengiriman ORD-2025-005 - AP Kreasi')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ url('/dashboard') }}"
               class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white transition-colors"
               aria-label="Kembali">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <nav class="flex items-center gap-2 text-sm text-slate-400" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ url('/dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white font-medium">Tracking</span>
            </nav>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-1">Tracking Pengiriman</h1>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="font-mono text-sm bg-white/10 text-white px-3 py-1 rounded-full">ORD-2025-005</span>
                    <span class="text-sm bg-orange-500/20 text-orange-300 border border-orange-500/30 px-3 py-1 rounded-full font-semibold">
                        <i class="fas fa-truck mr-1.5 animate-pulse"></i>Dalam Pengiriman
                    </span>
                </div>
            </div>
            {{-- Quick Search --}}
            <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 w-full sm:w-72">
                <i class="fas fa-search text-white/50 text-sm"></i>
                <input type="text" id="resi-input" placeholder="Cari nomor resi lain..."
                       class="bg-transparent text-sm text-white placeholder-white/40 outline-none w-full"
                       aria-label="Cari nomor resi">
                <button onclick="searchResi()" class="text-xs font-semibold text-blue-300 hover:text-white transition-colors">Cari</button>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

    {{-- ===== SHIPMENT INFO CARD ===== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-truck text-white text-lg"></i>
                </div>
                <div>
                    <p class="font-bold text-white">JNE YES — Dalam Pengiriman</p>
                    <p class="text-orange-100 text-xs">Estimasi tiba: <strong>Senin, 20 Januari 2025</strong></p>
                </div>
            </div>
            <div class="text-right hidden sm:block">
                <p class="text-xs text-orange-200">No. Resi</p>
                <p class="font-mono font-bold text-white text-sm">JNE2025011500123</p>
            </div>
        </div>

        <div class="p-6">
            {{-- Resi & Ekspedisi Info --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                @foreach([
                    ['No. Resi',    'JNE2025011500123', 'fa-barcode',       'blue'],
                    ['Ekspedisi',   'JNE YES',          'fa-truck',         'orange'],
                    ['Berat',       '8 kg',             'fa-weight-hanging','gray'],
                    ['Layanan',     'Estimasi 1-2 Hari','fa-clock',         'green'],
                ] as $info)
                <div class="bg-gray-50 rounded-xl p-3">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas {{ $info[3] === 'blue' ? 'text-blue-500' : ($info[3] === 'orange' ? 'text-orange-500' : ($info[3] === 'green' ? 'text-green-500' : 'text-gray-500')) }} fas {{ $info[2] }} text-xs"></i>
                        <p class="text-xs text-gray-400 font-medium">{{ $info[0] }}</p>
                    </div>
                    <p class="font-bold text-gray-900 text-sm font-mono">{{ $info[1] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Origin → Destination --}}
            <div class="flex items-center gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl mb-6">
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-warehouse text-white text-sm"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium">Pengirim</p>
                    <p class="font-bold text-gray-900 text-sm">AP Kreasi</p>
                    <p class="text-xs text-gray-500">Surabaya, Jawa Timur</p>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full flex items-center gap-1">
                        <div class="flex-1 h-0.5 bg-orange-300"></div>
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center animate-bounce">
                            <i class="fas fa-truck text-white text-xs"></i>
                        </div>
                        <div class="flex-1 h-0.5 bg-gray-200"></div>
                    </div>
                    <p class="text-xs text-orange-600 font-semibold mt-1">Dalam Perjalanan</p>
                </div>
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 bg-gray-200 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-map-marker-alt text-gray-500 text-sm"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium">Penerima</p>
                    <p class="font-bold text-gray-900 text-sm">Rudi Hartono</p>
                    <p class="text-xs text-gray-500">Jakarta Selatan, DKI Jakarta</p>
                </div>
            </div>

            {{-- Current Status Banner --}}
            <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 flex items-start gap-3">
                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-map-marker-alt text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <p class="font-bold text-orange-900">Paket dalam perjalanan ke kota tujuan</p>
                        <span class="text-xs text-orange-600 bg-orange-100 px-2.5 py-1 rounded-full font-semibold">Update terakhir: 2 jam lalu</span>
                    </div>
                    <p class="text-sm text-orange-700 mt-1">Paket Anda sedang dalam perjalanan dari <strong>Hub JNE Surabaya</strong> menuju <strong>Hub JNE Jakarta</strong>.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== TRACKING TIMELINE ===== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                <i class="fas fa-route text-blue-500"></i> Riwayat Perjalanan
            </h2>
            <button onclick="toggleAllHistory()" id="toggle-history-btn"
                    class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                <i class="fas fa-chevron-down" id="toggle-icon"></i> Lihat Semua
            </button>
        </div>

        @php
        $trackingHistory = [
            [
                'status'   => 'current',
                'icon'     => 'fa-truck',
                'color'    => 'orange',
                'title'    => 'Dalam Perjalanan ke Hub Tujuan',
                'location' => 'Hub JNE Surabaya → Jakarta',
                'desc'     => 'Paket telah berangkat dari Hub JNE Surabaya dan sedang dalam perjalanan menuju Hub JNE Jakarta.',
                'date'     => 'Sabtu, 18 Jan 2025',
                'time'     => '06:45 WIB',
                'show'     => true,
            ],
            [
                'status'   => 'done',
                'icon'     => 'fa-box-open',
                'color'    => 'blue',
                'title'    => 'Paket Diterima di Hub Asal',
                'location' => 'Hub JNE Surabaya, Jawa Timur',
                'desc'     => 'Paket telah diterima dan diproses di Hub JNE Surabaya. Berat terverifikasi: 8 kg.',
                'date'     => 'Jumat, 17 Jan 2025',
                'time'     => '20:30 WIB',
                'show'     => true,
            ],
            [
                'status'   => 'done',
                'icon'     => 'fa-warehouse',
                'color'    => 'blue',
                'title'    => 'Paket Diserahkan ke Kurir',
                'location' => 'Workshop AP Kreasi, Surabaya',
                'desc'     => 'Paket telah dikemas dan diserahkan kepada kurir JNE untuk proses pengiriman.',
                'date'     => 'Jumat, 17 Jan 2025',
                'time'     => '15:00 WIB',
                'show'     => true,
            ],
            [
                'status'   => 'done',
                'icon'     => 'fa-box',
                'color'    => 'purple',
                'title'    => 'Paket Dikemas',
                'location' => 'Workshop AP Kreasi, Surabaya',
                'desc'     => 'Produk selesai diproduksi dan dikemas dengan aman menggunakan bubble wrap dan kayu pelindung.',
                'date'     => 'Jumat, 17 Jan 2025',
                'time'     => '13:00 WIB',
                'show'     => false,
            ],
            [
                'status'   => 'done',
                'icon'     => 'fa-check-circle',
                'color'    => 'green',
                'title'    => 'Produksi Selesai & QC Passed',
                'location' => 'Workshop AP Kreasi, Surabaya',
                'desc'     => 'Produk telah selesai diproduksi dan lolos quality control. Siap untuk dikemas dan dikirim.',
                'date'     => 'Kamis, 16 Jan 2025',
                'time'     => '17:30 WIB',
                'show'     => false,
            ],
            [
                'status'   => 'done',
                'icon'     => 'fa-industry',
                'color'    => 'gray',
                'title'    => 'Produksi Dimulai',
                'location' => 'Workshop AP Kreasi, Surabaya',
                'desc'     => 'Tim produksi mulai mengerjakan pesanan setelah DP diterima dan desain disetujui.',
                'date'     => 'Rabu, 15 Jan 2025',
                'time'     => '09:00 WIB',
                'show'     => false,
            ],
        ];
        @endphp

        <div class="space-y-0" id="tracking-timeline">
            @foreach($trackingHistory as $i => $track)
            <div class="tracking-item flex gap-4 {{ !$track['show'] ? 'hidden-history hidden' : '' }}"
                 style="{{ $track['show'] ? '' : 'display:none' }}">
                {{-- Left: Icon + Line --}}
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 z-10
                        {{ $track['status'] === 'current'
                            ? 'bg-orange-500 border-orange-500 text-white ring-4 ring-orange-100'
                            : 'bg-green-500 border-green-500 text-white' }}">
                        @if($track['status'] === 'current')
                            <i class="fas {{ $track['icon'] }} text-sm animate-pulse"></i>
                        @else
                            <i class="fas fa-check text-sm"></i>
                        @endif
                    </div>
                    @if($i < count($trackingHistory) - 1)
                    <div class="w-0.5 flex-1 min-h-[2rem] mt-1
                        {{ $track['status'] === 'done' ? 'bg-green-200' : 'bg-gray-100' }}"></div>
                    @endif
                </div>

                {{-- Right: Content --}}
                <div class="pb-6 flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2 flex-wrap">
                        <div>
                            <p class="font-bold text-gray-900 text-sm
                                {{ $track['status'] === 'current' ? 'text-orange-700' : '' }}">
                                {{ $track['title'] }}
                                @if($track['status'] === 'current')
                                <span class="ml-2 text-xs bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full font-semibold">TERKINI</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>{{ $track['location'] }}
                            </p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-xs font-semibold text-gray-700">{{ $track['time'] }}</p>
                            <p class="text-xs text-gray-400">{{ $track['date'] }}</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed bg-gray-50 rounded-lg px-3 py-2">
                        {{ $track['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pending Steps --}}
        <div class="mt-2 pt-4 border-t border-gray-100">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Langkah Selanjutnya</p>
            <div class="space-y-3">
                @foreach([
                    ['fa-building', 'Tiba di Hub Tujuan', 'Paket akan tiba di Hub JNE Jakarta', 'Estimasi: Minggu, 19 Jan 2025'],
                    ['fa-motorcycle', 'Proses Pengiriman Terakhir', 'Kurir akan mengantar ke alamat Anda', 'Estimasi: Senin, 20 Jan 2025'],
                    ['fa-check-double', 'Paket Diterima', 'Konfirmasi penerimaan oleh penerima', 'Estimasi: Senin, 20 Jan 2025'],
                ] as $next)
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl opacity-60">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $next[0] }} text-gray-400 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-600">{{ $next[1] }}</p>
                        <p class="text-xs text-gray-400">{{ $next[2] }}</p>
                    </div>
                    <span class="text-xs text-gray-400 hidden sm:block">{{ $next[3] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== ORDER & PACKAGE INFO ===== --}}
    <div class="grid sm:grid-cols-2 gap-6">

        {{-- Order Summary --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-box text-blue-500"></i> Info Paket
            </h3>
            <div class="space-y-3">
                @foreach([
                    ['Produk',      'Baliho Flexi Premium',     'fa-image'],
                    ['Ukuran',      '4m × 3m',                  'fa-ruler-combined'],
                    ['Berat Paket', '8 kg',                     'fa-weight-hanging'],
                    ['Dimensi',     '120 × 80 × 15 cm',         'fa-cube'],
                    ['Dikemas',     'Bubble wrap + kayu',        'fa-shield-alt'],
                    ['Asuransi',    'Rp 360.000 (nilai barang)', 'fa-umbrella'],
                ] as $item)
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $item[2] }} text-blue-500 text-xs"></i>
                    </div>
                    <div class="flex-1 flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $item[0] }}</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $item[1] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Delivery Address --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-blue-500"></i> Alamat Pengiriman
            </h3>
            <div class="bg-gray-50 rounded-xl p-4 mb-4">
                <p class="font-bold text-gray-900 text-sm">Rudi Hartono</p>
                <p class="text-xs text-gray-500 mt-1">+62 813-9876-5432</p>
                <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                    Jl. Kemang Raya No. 88, Kemang,<br>
                    Jakarta Selatan, DKI Jakarta 12730
                </p>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Ongkos Kirim</span>
                    <span class="font-semibold text-gray-900">Rp 150.000</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Asuransi</span>
                    <span class="font-semibold text-green-600">Termasuk</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-5 space-y-2">
                <a href="https://www.jne.co.id/id/tracking/trace" target="_blank"
                   class="flex items-center justify-center gap-2 w-full py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm rounded-xl transition-colors">
                    <i class="fas fa-external-link-alt"></i> Cek di Website JNE
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20tanya%20status%20pengiriman%20ORD-2025-005%20resi%20JNE2025011500123"
                   target="_blank"
                   class="flex items-center justify-center gap-2 w-full py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold text-sm rounded-xl transition-colors">
                    <i class="fab fa-whatsapp"></i> Tanya via WhatsApp
                </a>
            </div>
        </div>
    </div>

    {{-- ===== CONFIRM RECEIVED ===== --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-center sm:text-left">
            <p class="font-bold text-white text-lg">Sudah menerima paket?</p>
            <p class="text-blue-200 text-sm mt-1">Konfirmasi penerimaan untuk menyelesaikan order Anda.</p>
        </div>
        <button onclick="confirmReceived()"
                class="flex-shrink-0 px-8 py-3 bg-white text-blue-700 font-bold rounded-xl hover:bg-blue-50 transition-colors shadow-lg">
            <i class="fas fa-check-circle mr-2"></i>Konfirmasi Diterima
        </button>
    </div>

</div>

{{-- Confirm Modal --}}
<div id="confirm-modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 animate-slide-up">
        <div class="text-center mb-5">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-box-open text-green-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 text-lg">Konfirmasi Penerimaan</h3>
            <p class="text-gray-500 text-sm mt-1">Pastikan paket sudah Anda terima dalam kondisi baik sebelum konfirmasi.</p>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-5 flex items-start gap-2">
            <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5 text-sm"></i>
            <p class="text-xs text-amber-700">Setelah konfirmasi, status order akan berubah menjadi <strong>Selesai</strong> dan tidak dapat dibatalkan.</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi Paket</label>
            <div class="space-y-2">
                @foreach(['Baik — Paket diterima dalam kondisi sempurna', 'Rusak ringan — Ada kerusakan kecil pada kemasan', 'Rusak — Produk mengalami kerusakan'] as $cond)
                <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 transition-colors">
                    <input type="radio" name="condition" class="accent-blue-600">
                    <span class="text-sm text-gray-700">{{ $cond }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="flex gap-3">
            <button onclick="closeConfirmModal()" class="flex-1 py-3 border-2 border-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button onclick="submitConfirm()" class="flex-1 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors">
                <i class="fas fa-check mr-2"></i>Konfirmasi
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let historyVisible = false;

function toggleAllHistory() {
    historyVisible = !historyVisible;
    const hiddenItems = document.querySelectorAll('.hidden-history');
    const btn = document.getElementById('toggle-history-btn');
    const icon = document.getElementById('toggle-icon');

    hiddenItems.forEach(item => {
        item.style.display = historyVisible ? 'flex' : 'none';
    });

    btn.innerHTML = historyVisible
        ? '<i class="fas fa-chevron-up" id="toggle-icon"></i> Sembunyikan'
        : '<i class="fas fa-chevron-down" id="toggle-icon"></i> Lihat Semua';
}

function confirmReceived() {
    document.getElementById('confirm-modal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirm-modal').classList.add('hidden');
}

function submitConfirm() {
    const selected = document.querySelector('input[name="condition"]:checked');
    if (!selected) {
        alert('Pilih kondisi paket terlebih dahulu.');
        return;
    }

    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';

    setTimeout(() => {
        closeConfirmModal();
        // Show success toast
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 z-50 animate-slide-up';
        toast.innerHTML = '<i class="fas fa-check-circle text-xl"></i><div><p class="font-bold">Penerimaan Dikonfirmasi!</p><p class="text-sm text-green-200">Order ORD-2025-005 telah selesai.</p></div>';
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);

        // Redirect to dashboard
        setTimeout(() => window.location.href = '{{ url("/dashboard") }}', 2000);
    }, 1500);
}

function searchResi() {
    const val = document.getElementById('resi-input').value.trim();
    if (val) alert(`Mencari resi: ${val}\n\n(Fitur ini akan terhubung ke API ekspedisi)`);
}
</script>
@endpush
