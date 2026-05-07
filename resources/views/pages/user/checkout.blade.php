@extends('layouts.app')

@section('title', 'Checkout - AP Kreasi')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-slate-400 mb-4" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ url('/kalkulator') }}" class="hover:text-white transition-colors">Kalkulator</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-white font-medium">Checkout</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Checkout</h1>

        {{-- Progress Steps --}}
        <div class="flex items-center gap-0 max-w-lg">
            @php
            $steps = [
                ['label' => 'Kalkulator', 'done' => true,  'active' => false],
                ['label' => 'Checkout',   'done' => false, 'active' => true],
                ['label' => 'Pembayaran', 'done' => false, 'active' => false],
                ['label' => 'Konfirmasi', 'done' => false, 'active' => false],
            ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="flex items-center {{ $i < count($steps) - 1 ? 'flex-1' : '' }}">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                        {{ $step['done'] ? 'bg-green-500 text-white' : ($step['active'] ? 'bg-blue-500 text-white ring-4 ring-blue-500/30' : 'bg-white/20 text-white/50') }}">
                        @if($step['done'])
                        <i class="fas fa-check text-xs"></i>
                        @else
                        {{ $i + 1 }}
                        @endif
                    </div>
                    <span class="text-xs mt-1 {{ $step['active'] ? 'text-white font-semibold' : ($step['done'] ? 'text-green-300' : 'text-white/40') }}">
                        {{ $step['label'] }}
                    </span>
                </div>
                @if($i < count($steps) - 1)
                <div class="flex-1 h-0.5 mx-2 mb-4 {{ $step['done'] ? 'bg-green-400' : 'bg-white/20' }}"></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ===== LEFT: FORM ===== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Customer Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-5 flex items-center gap-2">
                    <i class="fas fa-user text-blue-500"></i> Informasi Pelanggan
                </h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" value="Budi Santoso"
                               class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                               aria-label="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                            <span class="px-3 py-2.5 bg-gray-50 text-sm text-gray-500 border-r border-gray-200">+62</span>
                            <input type="tel" value="81234567890"
                                   class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                                   aria-label="Nomor WhatsApp">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" value="budi.santoso@email.com"
                               class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                               aria-label="Email">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kota <span class="text-red-500">*</span></label>
                        <input type="text" value="Surabaya"
                               class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                               aria-label="Kota">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea rows="2"
                                  class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all resize-none"
                                  aria-label="Alamat lengkap">Jl. Raya Darmo No. 45, Surabaya Pusat</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan Tambahan</label>
                        <textarea rows="2" placeholder="Catatan khusus untuk tim produksi..."
                                  class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all resize-none"
                                  aria-label="Catatan tambahan"></textarea>
                    </div>
                </div>
            </div>

            {{-- Shipping Method --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-5 flex items-center gap-2">
                    <i class="fas fa-shipping-fast text-blue-500"></i> Pilih Ekspedisi
                </h2>

                @php
                $expeditions = [
                    ['id' => 'jne-reg',    'name' => 'JNE Regular',      'icon' => 'fa-truck',        'price' => 100000, 'estimate' => '3-5 hari',  'desc' => 'Pengiriman standar dengan tracking', 'color' => 'red'],
                    ['id' => 'jne-yes',    'name' => 'JNE YES',          'icon' => 'fa-shipping-fast', 'price' => 150000, 'estimate' => '1-2 hari',  'desc' => 'Pengiriman cepat dengan asuransi',   'color' => 'red', 'recommended' => true],
                    ['id' => 'jnt',        'name' => 'J&T Express',      'icon' => 'fa-truck',        'price' => 85000,  'estimate' => '3-4 hari',  'desc' => 'Ekonomis dengan layanan baik',       'color' => 'red'],
                    ['id' => 'sicepat',    'name' => 'SiCepat Halu',     'icon' => 'fa-truck-fast',   'price' => 95000,  'estimate' => '2-4 hari',  'desc' => 'Cepat dan terpercaya',               'color' => 'yellow'],
                    ['id' => 'anteraja',   'name' => 'AnterAja',         'icon' => 'fa-truck',        'price' => 80000,  'estimate' => '3-5 hari',  'desc' => 'Harga terjangkau',                    'color' => 'blue'],
                    ['id' => 'pickup',     'name' => 'Ambil Sendiri',    'icon' => 'fa-store',        'price' => 0,      'estimate' => 'Langsung',  'desc' => 'Gratis - Ambil di workshop kami',     'color' => 'green'],
                ];
                @endphp

                <div class="space-y-3 mb-6" id="expedition-options">
                    @foreach($expeditions as $exp)
                    <label class="expedition-option flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200
                        {{ $exp['id'] === 'jne-yes' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300 hover:bg-gray-50' }}"
                        onclick="selectExpedition('{{ $exp['id'] }}', {{ $exp['price'] }})">
                        <input type="radio" name="expedition" value="{{ $exp['id'] }}" {{ $exp['id'] === 'jne-yes' ? 'checked' : '' }}
                               class="accent-blue-600" aria-label="{{ $exp['name'] }}">
                        <div class="w-10 h-10 bg-{{ $exp['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $exp['icon'] }} text-{{ $exp['color'] }}-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="font-semibold text-gray-900 text-sm">{{ $exp['name'] }}</span>
                                @if(isset($exp['recommended']) && $exp['recommended'])
                                <span class="text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full font-semibold">Recommended</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400">{{ $exp['desc'] }}</p>
                            <p class="text-xs text-gray-500 mt-1"><i class="far fa-clock mr-1"></i>Estimasi: {{ $exp['estimate'] }}</p>
                        </div>
                        <div class="text-right">
                            @if($exp['price'] > 0)
                            <span class="font-bold text-gray-900 text-sm">Rp {{ number_format($exp['price'], 0, ',', '.') }}</span>
                            @else
                            <span class="font-bold text-green-600 text-sm">GRATIS</span>
                            @endif
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Shipping Info --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-blue-800">Informasi Pengiriman</p>
                        <p class="text-xs text-blue-700 mt-0.5">Produk akan dikemas dengan aman dan dilengkapi asuransi. Tracking number akan dikirim via WhatsApp.</p>
                    </div>
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-lg mb-5 flex items-center gap-2">
                    <i class="fas fa-credit-card text-blue-500"></i> Metode Pembayaran
                </h2>

                {{-- DP Info --}}
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-5 flex items-start gap-3">
                    <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-amber-800">Pembayaran DP 50%</p>
                        <p class="text-xs text-amber-700 mt-0.5">Produksi dimulai setelah DP diterima. Pelunasan dilakukan saat produk siap dikirim.</p>
                    </div>
                </div>

                @php
                $paymentMethods = [
                    ['id' => 'bca',     'label' => 'Transfer BCA',          'icon' => 'fa-university',  'desc' => 'BCA 1234567890 a/n AP Kreasi',          'recommended' => false, 'color' => 'blue'],
                    ['id' => 'mandiri', 'label' => 'Transfer Mandiri',       'icon' => 'fa-university',  'desc' => 'Mandiri 0987654321 a/n AP Kreasi',       'recommended' => false, 'color' => 'yellow'],
                    ['id' => 'qris',    'label' => 'QRIS',                   'icon' => 'fa-qrcode',      'desc' => 'Scan QR dari semua e-wallet & m-banking', 'recommended' => true,  'color' => 'purple'],
                    ['id' => 'ewallet', 'label' => 'GoPay / OVO / Dana',     'icon' => 'fa-mobile-alt',  'desc' => 'Transfer ke nomor 081234567890',          'recommended' => false, 'color' => 'green'],
                    ['id' => 'cod',     'label' => 'Bayar saat Pemasangan',  'icon' => 'fa-tools',       'desc' => 'Khusus area Surabaya & sekitarnya',       'recommended' => false, 'color' => 'gray'],
                ];
                @endphp

                <div class="space-y-3" id="payment-methods">
                    @foreach($paymentMethods as $pm)
                    <label class="payment-option flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200
                        {{ $pm['id'] === 'qris' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300 hover:bg-gray-50' }}"
                        onclick="selectPayment('{{ $pm['id'] }}')">
                        <input type="radio" name="payment" value="{{ $pm['id'] }}" {{ $pm['id'] === 'qris' ? 'checked' : '' }}
                               class="accent-blue-600" aria-label="{{ $pm['label'] }}">
                        <div class="w-10 h-10 bg-{{ $pm['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $pm['icon'] }} text-{{ $pm['color'] }}-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-gray-900 text-sm">{{ $pm['label'] }}</span>
                                @if($pm['recommended'])
                                <span class="text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full font-semibold">Recommended</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $pm['desc'] }}</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== RIGHT: ORDER SUMMARY ===== --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-4">
                {{-- Order Summary Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-6 py-4">
                        <h3 class="font-bold text-white">Ringkasan Order</h3>
                    </div>
                    <div class="p-6">
                        {{-- Product --}}
                        <div class="flex gap-4 mb-5 pb-5 border-b border-gray-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-lightbulb text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Neon Box LED Akrilik</p>
                                <p class="text-xs text-gray-400 mt-0.5">2m × 1m • Akrilik 5mm</p>
                                <p class="text-xs text-gray-400">LED Strip • Desain Custom</p>
                            </div>
                        </div>

                        {{-- Price Breakdown --}}
                        <div class="space-y-2.5 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Material (2m²)</span>
                                <span class="font-medium text-gray-800">Rp 1.600.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Lampu LED Strip</span>
                                <span class="font-medium text-gray-800">Rp 150.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Desain</span>
                                <span class="font-medium text-gray-800">Rp 250.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Pemasangan</span>
                                <span class="font-medium text-gray-800">Rp 300.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Ongkir <span id="expedition-name" class="text-xs">(JNE YES)</span></span>
                                <span class="font-medium text-gray-800" id="shipping-cost">Rp 150.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-green-600 font-medium">Diskon HEMAT10</span>
                                <span class="font-medium text-green-600" id="discount-amount">-Rp 245.000</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="font-extrabold text-blue-600 text-xl" id="total-price">Rp 2.205.000</span>
                            </div>
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-amber-700 font-semibold">DP 50% (sekarang)</span>
                                    <span class="font-bold text-amber-800" id="dp-amount">Rp 1.102.500</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Pelunasan</span>
                                    <span class="font-medium text-gray-700" id="remaining-amount">Rp 1.102.500</span>
                                </div>
                            </div>
                        </div>

                        {{-- Pay Button --}}
                        <button id="pay-btn" onclick="handlePayment()"
                                class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-blue-200 mb-3">
                            <i class="fas fa-lock mr-2"></i>Bayar Sekarang — <span id="pay-btn-amount">Rp 1.102.500</span>
                        </button>
                        <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20konfirmasi%20order"
                           target="_blank"
                           class="block w-full text-center py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors mb-4">
                            <i class="fab fa-whatsapp mr-2"></i>Konfirmasi via WhatsApp
                        </a>

                        {{-- Security Badges --}}
                        <div class="flex items-center justify-center gap-4 pt-3 border-t border-gray-100">
                            @foreach([['fa-lock', 'SSL Aman'], ['fa-shield-alt', 'Data Aman'], ['fa-award', 'Garansi']] as $badge)
                            <div class="flex flex-col items-center gap-1">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas {{ $badge[0] }} text-gray-500 text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-400">{{ $badge[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Base prices
const BASE_PRICES = {
    material: 1600000,
    led: 150000,
    design: 250000,
    installation: 300000,
    discountPercent: 10
};

// Expedition data
const EXPEDITIONS = {
    'jne-reg': { name: 'JNE Regular', price: 100000 },
    'jne-yes': { name: 'JNE YES', price: 150000 },
    'jnt': { name: 'J&T Express', price: 85000 },
    'sicepat': { name: 'SiCepat Halu', price: 95000 },
    'anteraja': { name: 'AnterAja', price: 80000 },
    'pickup': { name: 'Ambil Sendiri', price: 0 }
};

let currentShippingCost = 150000; // Default JNE YES

function formatRupiah(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

function calculateTotal() {
    const subtotal = BASE_PRICES.material + BASE_PRICES.led + BASE_PRICES.design + BASE_PRICES.installation + currentShippingCost;
    const discount = Math.round(subtotal * BASE_PRICES.discountPercent / 100);
    const total = subtotal - discount;
    const dp = Math.round(total / 2);
    const remaining = total - dp;

    return { subtotal, discount, total, dp, remaining };
}

function updatePriceSummary() {
    const prices = calculateTotal();
    
    document.getElementById('shipping-cost').textContent = formatRupiah(currentShippingCost);
    document.getElementById('discount-amount').textContent = '-' + formatRupiah(prices.discount);
    document.getElementById('total-price').textContent = formatRupiah(prices.total);
    document.getElementById('dp-amount').textContent = formatRupiah(prices.dp);
    document.getElementById('remaining-amount').textContent = formatRupiah(prices.remaining);
    document.getElementById('pay-btn-amount').textContent = formatRupiah(prices.dp);
}

function selectExpedition(id, price) {
    // Update visual selection
    document.querySelectorAll('.expedition-option').forEach(el => {
        const isSelected = el.querySelector('input').value === id;
        el.className = `expedition-option flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 ${
            isSelected ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300 hover:bg-gray-50'
        }`;
        if (isSelected) el.querySelector('input').checked = true;
    });

    // Update shipping cost
    currentShippingCost = price;
    
    // Update expedition name in summary
    const expeditionName = EXPEDITIONS[id].name;
    document.getElementById('expedition-name').textContent = `(${expeditionName})`;
    
    // Recalculate and update prices
    updatePriceSummary();
}

function selectPayment(id) {
    document.querySelectorAll('.payment-option').forEach(el => {
        const isSelected = el.querySelector('input').value === id;
        el.className = `payment-option flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 ${
            isSelected ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300 hover:bg-gray-50'
        }`;
        if (isSelected) el.querySelector('input').checked = true;
    });
}

function handlePayment() {
    const btn = document.getElementById('pay-btn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses Pembayaran...';
    btn.className = btn.className.replace('hover:-translate-y-0.5', '');

    setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-check mr-2"></i>Pembayaran Berhasil!';
        btn.className = btn.className.replace('from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800', 'from-green-500 to-green-600');
    }, 2000);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePriceSummary();
});
</script>
@endpush
