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
                            <div class="flex justify-between text-sm">
                                <span class="text-green-600 font-medium">Diskon HEMAT10</span>
                                <span class="font-medium text-green-600">-Rp 240.000</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="font-extrabold text-blue-600 text-xl">Rp 2.160.000</span>
                            </div>
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-amber-700 font-semibold">DP 50% (sekarang)</span>
                                    <span class="font-bold text-amber-800">Rp 1.080.000</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Pelunasan</span>
                                    <span class="font-medium text-gray-700">Rp 1.080.000</span>
                                </div>
                            </div>
                        </div>

                        {{-- Pay Button --}}
                        <button id="pay-btn" onclick="handlePayment()"
                                class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-blue-200 mb-3">
                            <i class="fas fa-lock mr-2"></i>Bayar Sekarang — Rp 1.080.000
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
</script>
@endpush
