@extends('layouts.admin')

@section('title', 'Pengaturan Harga - Admin')
@section('page-title', 'Pengaturan Harga')
@section('page-subtitle', 'Konfigurasi komponen harga kalkulator')

@section('content')

<div class="grid lg:grid-cols-5 gap-6">

    {{-- ===== LEFT: Pricing Form ===== --}}
    <div class="lg:col-span-3">
        <x-card title="Komponen Harga" subtitle="Ubah harga dasar untuk kalkulator otomatis">
            @php
            $pricingFields = [
                ['id' => 'price_per_m2',    'label' => 'Harga per m²',          'icon' => 'fa-ruler-combined', 'default' => '750000',  'desc' => 'Harga dasar material per meter persegi (Neon Box)'],
                ['id' => 'design_fee',      'label' => 'Biaya Desain',           'icon' => 'fa-pencil-ruler',   'default' => '250000',  'desc' => 'Biaya jasa desain grafis per order'],
                ['id' => 'install_fee',     'label' => 'Biaya Pemasangan',       'icon' => 'fa-tools',          'default' => '300000',  'desc' => 'Biaya jasa pemasangan di lokasi pelanggan'],
                ['id' => 'packing_fee',     'label' => 'Biaya Packing Kayu',     'icon' => 'fa-box',            'default' => '150000',  'desc' => 'Biaya packing kayu untuk pengiriman aman'],
                ['id' => 'shipping_base',   'label' => 'Ongkir Dasar',           'icon' => 'fa-truck',          'default' => '100000',  'desc' => 'Ongkos kirim dasar (dapat berubah sesuai jarak)'],
            ];
            @endphp

            <div class="space-y-5">
                @foreach($pricingFields as $field)
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas {{ $field['icon'] }} text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-800 mb-0.5" for="{{ $field['id'] }}">
                            {{ $field['label'] }}
                        </label>
                        <p class="text-xs text-gray-400 mb-2">{{ $field['desc'] }}</p>
                        <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all bg-white">
                            <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">Rp</span>
                            <input type="number" id="{{ $field['id'] }}" value="{{ $field['default'] }}" min="0"
                                   oninput="updatePreview()"
                                   class="flex-1 px-3 py-2.5 text-sm outline-none bg-white font-semibold"
                                   aria-label="{{ $field['label'] }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex gap-3 mt-6 pt-5 border-t border-gray-100">
                <button class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                </button>
                <button onclick="resetToDefault()"
                        class="px-5 py-3 border-2 border-gray-200 hover:border-gray-300 text-gray-600 hover:text-gray-800 text-sm font-semibold rounded-xl transition-all">
                    <i class="fas fa-undo mr-1.5"></i>Reset ke Default
                </button>
            </div>
        </x-card>
    </div>

    {{-- ===== RIGHT: Preview + Info ===== --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Price Preview --}}
        <x-card title="Preview Kalkulasi" subtitle="Contoh: Neon Box 2m × 1m">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-5 mb-4">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calculator text-white"></i>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">Neon Box Akrilik 5mm</p>
                        <p class="text-blue-100 text-xs">2m × 1m = 2 m²</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Material (2 m²)</span>
                        <span class="text-white font-semibold" id="preview-material">Rp 1.500.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Biaya Desain</span>
                        <span class="text-white font-semibold" id="preview-design">Rp 250.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Pemasangan</span>
                        <span class="text-white font-semibold" id="preview-install">Rp 300.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Ongkir</span>
                        <span class="text-white font-semibold" id="preview-shipping">Rp 100.000</span>
                    </div>
                    <div class="border-t border-white/20 pt-2 flex justify-between">
                        <span class="font-bold text-white">Total Estimasi</span>
                        <span class="font-extrabold text-cyan-300 text-lg" id="preview-total">Rp 2.150.000</span>
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-400 text-center">
                <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                Preview diperbarui otomatis saat Anda mengubah harga
            </p>
        </x-card>

        {{-- Info Card --}}
        <x-card title="Panduan Komponen Harga">
            <div class="space-y-3">
                @foreach([
                    ['fa-ruler-combined', 'blue',   'Harga per m²',        'Harga dasar material dikalikan luas area produk. Setiap jenis produk memiliki multiplier berbeda.'],
                    ['fa-pencil-ruler',   'purple', 'Biaya Desain',        'Biaya tetap per order untuk jasa desain grafis. Sudah termasuk 3x revisi.'],
                    ['fa-tools',          'orange', 'Biaya Pemasangan',    'Biaya jasa pemasangan di lokasi. Khusus area Surabaya & sekitarnya.'],
                    ['fa-box',            'green',  'Packing Kayu',        'Biaya packing kayu untuk produk berukuran besar agar aman saat pengiriman.'],
                    ['fa-truck',          'cyan',   'Ongkir Dasar',        'Ongkos kirim dasar. Biaya aktual dapat berbeda tergantung jarak dan berat.'],
                ] as $info)
                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-7 h-7 bg-{{ $info[1] }}-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas {{ $info[0] }} text-{{ $info[1] }}-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">{{ $info[2] }}</p>
                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $info[3] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </x-card>

        {{-- Last Updated --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex items-center gap-3">
            <div class="w-9 h-9 bg-gray-200 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-history text-gray-500 text-sm"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-700">Terakhir Diperbarui</p>
                <p class="text-xs text-gray-500 mt-0.5">15 Januari 2025 oleh <span class="font-semibold text-gray-700">Admin Utama</span></p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const DEFAULTS = {
    price_per_m2:  750000,
    design_fee:    250000,
    install_fee:   300000,
    packing_fee:   150000,
    shipping_base: 100000,
};

function formatRp(amount) {
    return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
}

function updatePreview() {
    const pricePerM2  = parseInt(document.getElementById('price_per_m2').value)  || 0;
    const designFee   = parseInt(document.getElementById('design_fee').value)     || 0;
    const installFee  = parseInt(document.getElementById('install_fee').value)    || 0;
    const shippingFee = parseInt(document.getElementById('shipping_base').value)  || 0;

    const area = 2; // 2m x 1m example
    const materialCost = pricePerM2 * area;
    const total = materialCost + designFee + installFee + shippingFee;

    document.getElementById('preview-material').textContent = formatRp(materialCost);
    document.getElementById('preview-design').textContent   = formatRp(designFee);
    document.getElementById('preview-install').textContent  = formatRp(installFee);
    document.getElementById('preview-shipping').textContent = formatRp(shippingFee);
    document.getElementById('preview-total').textContent    = formatRp(total);
}

function resetToDefault() {
    if (!confirm('Reset semua harga ke nilai default?')) return;
    Object.entries(DEFAULTS).forEach(([id, val]) => {
        const el = document.getElementById(id);
        if (el) el.value = val;
    });
    updatePreview();
}

// Initialize preview on load
updatePreview();
</script>
@endpush
