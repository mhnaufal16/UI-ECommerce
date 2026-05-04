@extends('layouts.app')

@section('title', 'Kalkulator Harga - AP Kreasi')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">Kalkulator Harga</h1>
        <p class="text-slate-300">Hitung estimasi harga reklame & neon box Anda secara instan dan transparan.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ===== LEFT: FORM ===== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- STEP 1: Product Type --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">1</div>
                    <h2 class="font-bold text-gray-900 text-lg">Pilih Jenis Produk</h2>
                </div>
                @php
                $productTypes = [
                    ['id' => 'neonbox',  'label' => 'Neon Box',       'icon' => 'fa-lightbulb', 'price' => 750000,  'color' => 'blue'],
                    ['id' => 'reklame',  'label' => 'Reklame',        'icon' => 'fa-sign',      'price' => 500000,  'color' => 'purple'],
                    ['id' => 'letter',   'label' => 'Letter Timbul',  'icon' => 'fa-font',      'price' => 200000,  'color' => 'gray'],
                    ['id' => 'baliho',   'label' => 'Baliho',         'icon' => 'fa-image',     'price' => 30000,   'color' => 'green'],
                    ['id' => 'signage',  'label' => 'Signage',        'icon' => 'fa-building',  'price' => 350000,  'color' => 'cyan'],
                    ['id' => 'branding', 'label' => 'Branding',       'icon' => 'fa-car',       'price' => 200000,  'color' => 'red'],
                ];
                @endphp
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="product-type-grid">
                    @foreach($productTypes as $pt)
                    <button type="button"
                            onclick="selectProductType('{{ $pt['id'] }}', {{ $pt['price'] }})"
                            data-type="{{ $pt['id'] }}"
                            class="product-type-btn flex flex-col items-center gap-2 p-4 rounded-xl border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 text-center group">
                        <div class="w-10 h-10 bg-gray-100 group-hover:bg-blue-100 rounded-xl flex items-center justify-center transition-colors">
                            <i class="fas {{ $pt['icon'] }} text-gray-500 group-hover:text-blue-600 transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-700">{{ $pt['label'] }}</span>
                        <span class="text-xs text-gray-400">Rp {{ number_format($pt['price'], 0, ',', '.') }}/m²</span>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- STEP 2: Dimensions --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">2</div>
                    <h2 class="font-bold text-gray-900 text-lg">Ukuran Produk</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                    @foreach([['panjang', 'Panjang', 'fa-arrows-left-right'], ['lebar', 'Lebar', 'fa-arrows-up-down'], ['tinggi', 'Tinggi (opsional)', 'fa-ruler-vertical']] as $dim)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            <i class="fas {{ $dim[2] }} text-blue-500 mr-1.5"></i>{{ $dim[1] }}
                        </label>
                        <div class="flex rounded-xl border border-gray-200 overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                            <input type="number" id="dim-{{ $dim[0] }}" min="0" step="0.1" placeholder="0"
                                   oninput="calculatePrice()"
                                   class="flex-1 px-3 py-2.5 text-sm outline-none bg-white"
                                   aria-label="{{ $dim[1] }}">
                            <select onchange="calculatePrice()" class="px-2 py-2.5 text-xs bg-gray-50 border-l border-gray-200 outline-none text-gray-600" aria-label="Satuan {{ $dim[1] }}">
                                <option value="m">m</option>
                                <option value="cm">cm</option>
                            </select>
                        </div>
                        <p class="text-xs text-red-500 mt-1 hidden dim-error" id="err-{{ $dim[0] }}">Masukkan ukuran yang valid</p>
                    </div>
                    @endforeach
                </div>
                {{-- Area Preview --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-center gap-3">
                    <i class="fas fa-ruler-combined text-blue-500"></i>
                    <div>
                        <p class="text-xs text-blue-600 font-medium">Luas Area</p>
                        <p class="font-bold text-blue-800 text-lg" id="area-preview">0 m²</p>
                    </div>
                </div>
            </div>

            {{-- STEP 3: Material & Lamp --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">3</div>
                    <h2 class="font-bold text-gray-900 text-lg">Material & Lampu</h2>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-layer-group text-blue-500 mr-1.5"></i>Material
                        </label>
                        <select id="material-select" onchange="calculatePrice()"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all bg-white"
                                aria-label="Pilih material">
                            <option value="0">Pilih Material</option>
                            <option value="0">Akrilik 3mm</option>
                            <option value="50000">Akrilik 5mm (+Rp 50.000/m²)</option>
                            <option value="120000">Akrilik 10mm (+Rp 120.000/m²)</option>
                            <option value="200000">Stainless (+Rp 200.000/m²)</option>
                            <option value="80000">Galvanis (+Rp 80.000/m²)</option>
                            <option value="0">Flexi</option>
                            <option value="60000">Aluminium (+Rp 60.000/m²)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-bolt text-yellow-500 mr-1.5"></i>Jenis Lampu
                        </label>
                        <div class="space-y-2">
                            @foreach([['none', 'Tanpa Lampu', 0], ['led-strip', 'LED Strip', 150000], ['led-modul', 'LED Modul', 250000], ['neon-flex', 'Neon Flex', 350000]] as $lamp)
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                <input type="radio" name="lamp-type" value="{{ $lamp[1] }}" data-price="{{ $lamp[2] }}"
                                       onchange="calculatePrice()"
                                       {{ $loop->first ? 'checked' : '' }}
                                       class="text-blue-600 accent-blue-600">
                                <span class="text-sm font-medium text-gray-700 flex-1">{{ $lamp[1] }}</span>
                                @if($lamp[2] > 0)
                                <span class="text-xs text-blue-600 font-semibold">+Rp {{ number_format($lamp[2], 0, ',', '.') }}</span>
                                @else
                                <span class="text-xs text-gray-400">Gratis</span>
                                @endif
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- STEP 4: File Upload --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">4</div>
                    <h2 class="font-bold text-gray-900 text-lg">Upload File Desain</h2>
                </div>
                <div id="drop-zone"
                     class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-200 cursor-pointer"
                     onclick="document.getElementById('file-input').click()"
                     ondragover="event.preventDefault(); this.classList.add('border-blue-500','bg-blue-50')"
                     ondragleave="this.classList.remove('border-blue-500','bg-blue-50')"
                     ondrop="handleFileDrop(event)">
                    <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl"></i>
                    </div>
                    <p class="font-semibold text-gray-700 mb-1">Drag & drop file di sini</p>
                    <p class="text-sm text-gray-400 mb-3">atau klik untuk memilih file</p>
                    <p class="text-xs text-gray-400">Format: AI, PDF, PNG, JPG (maks. 20MB)</p>
                    <input type="file" id="file-input" class="hidden" accept=".ai,.pdf,.png,.jpg,.jpeg" onchange="handleFileUpload(event)">
                </div>
                <div id="file-preview" class="hidden mt-3 flex items-center gap-3 bg-green-50 border border-green-200 rounded-xl p-3">
                    <i class="fas fa-file-alt text-green-600"></i>
                    <span id="file-name" class="text-sm text-green-700 font-medium flex-1 truncate"></span>
                    <button onclick="removeFile()" class="text-red-400 hover:text-red-600 transition-colors" aria-label="Hapus file">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-2">
                    <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                    Belum punya desain? Tim kami siap membantu. Biaya desain sudah termasuk dalam estimasi.
                </p>
            </div>

            {{-- STEP 5: Promo Code --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">5</div>
                    <h2 class="font-bold text-gray-900 text-lg">Kode Promo</h2>
                </div>
                <div class="flex gap-3">
                    <input type="text" id="promo-input" placeholder="Masukkan kode promo"
                           class="flex-1 px-4 py-2.5 text-sm border border-gray-200 rounded-xl outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all uppercase"
                           aria-label="Kode promo">
                    <button onclick="applyPromo()"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors">
                        Terapkan
                    </button>
                </div>
                <div id="promo-result" class="hidden mt-3"></div>
                <p class="text-xs text-gray-400 mt-2">
                    <i class="fas fa-tag text-blue-400 mr-1"></i>
                    Coba kode: <span class="font-mono font-bold text-blue-600 cursor-pointer hover:underline" onclick="document.getElementById('promo-input').value='HEMAT10'">HEMAT10</span>
                    atau <span class="font-mono font-bold text-blue-600 cursor-pointer hover:underline" onclick="document.getElementById('promo-input').value='GRATIS50'">GRATIS50</span>
                </p>
            </div>
        </div>

        {{-- ===== RIGHT: PRICE SUMMARY ===== --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                        <h3 class="font-bold text-white text-lg">Estimasi Harga</h3>
                        <p class="text-blue-100 text-xs mt-0.5">Harga dapat berubah sesuai spesifikasi final</p>
                    </div>

                    <div class="p-6">
                        {{-- Skeleton Loading --}}
                        <div id="price-skeleton" class="hidden space-y-3">
                            <div class="skeleton h-4 w-3/4"></div>
                            <div class="skeleton h-4 w-1/2"></div>
                            <div class="skeleton h-4 w-2/3"></div>
                            <div class="skeleton h-4 w-1/2"></div>
                            <div class="skeleton h-6 w-full mt-4"></div>
                        </div>

                        {{-- Empty State --}}
                        <div id="price-empty">
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-calculator text-gray-300 text-2xl"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-500 mb-1">Belum ada kalkulasi</p>
                                <p class="text-xs text-gray-400">Pilih produk dan masukkan ukuran untuk melihat estimasi harga.</p>
                            </div>
                        </div>

                        {{-- Price Breakdown --}}
                        <div id="price-breakdown" class="hidden">
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Material (<span id="bd-area">0</span> m²)</span>
                                    <span class="font-medium text-gray-800" id="bd-material">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Lampu</span>
                                    <span class="font-medium text-gray-800" id="bd-lamp">Rp 0</span>
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
                                    <span class="text-gray-500">Ongkir</span>
                                    <span class="font-medium text-gray-800">Rp 100.000</span>
                                </div>
                                <div id="discount-row" class="hidden flex justify-between text-sm">
                                    <span class="text-green-600 font-medium">Diskon Promo</span>
                                    <span class="font-medium text-green-600" id="bd-discount">-Rp 0</span>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 pt-4 mb-5">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-900">Total Estimasi</span>
                                    <span class="font-extrabold text-blue-600 text-xl" id="bd-total">Rp 0</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Belum termasuk pajak</p>
                            </div>

                            <a href="{{ url('/checkout') }}"
                               class="block w-full text-center py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-blue-200 mb-3">
                                <i class="fas fa-shopping-cart mr-2"></i>Checkout Sekarang
                            </a>
                            <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20konsultasi"
                               target="_blank"
                               class="block w-full text-center py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors mb-4">
                                <i class="fab fa-whatsapp mr-2"></i>Konsultasi via WhatsApp
                            </a>
                        </div>

                        {{-- Guarantee Box --}}
                        <div class="bg-gray-50 rounded-xl p-4 mt-2">
                            <p class="text-xs font-bold text-gray-700 mb-2">
                                <i class="fas fa-shield-alt text-blue-500 mr-1.5"></i>Jaminan Kami
                            </p>
                            <ul class="space-y-1.5">
                                @foreach(['Garansi produk 1 tahun', 'Harga transparan, no hidden fee', 'Revisi desain gratis 3x', 'Pengiriman aman & terjamin'] as $g)
                                <li class="flex items-center gap-2 text-xs text-gray-500">
                                    <i class="fas fa-check text-green-500 text-[10px]"></i>{{ $g }}
                                </li>
                                @endforeach
                            </ul>
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
const PRICING = {
    neonbox: 750000,
    reklame: 500000,
    letter: 200000,
    baliho: 30000,
    signage: 350000,
    branding: 200000
};

const PROMO_CODES = {
    HEMAT10:  { type: 'percent', value: 10 },
    GRATIS50: { type: 'flat',    value: 50000 },
    APKREASI: { type: 'percent', value: 15 }
};

let selectedType = null;
let selectedTypePrice = 0;
let appliedDiscount = 0;
let calcTimer = null;

function selectProductType(type, price) {
    selectedType = type;
    selectedTypePrice = price;

    document.querySelectorAll('.product-type-btn').forEach(btn => {
        const isActive = btn.dataset.type === type;
        btn.className = `product-type-btn flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-200 text-center group ${
            isActive
                ? 'border-blue-500 bg-blue-50 shadow-sm'
                : 'border-gray-200 hover:border-blue-400 hover:bg-blue-50'
        }`;
        const icon = btn.querySelector('i');
        const iconWrap = btn.querySelector('div');
        if (isActive) {
            iconWrap.className = 'w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center transition-colors';
            icon.className = icon.className.replace('text-gray-500', 'text-blue-600');
        }
    });

    calculatePrice();
}

function calculatePrice() {
    clearTimeout(calcTimer);

    if (!selectedType) return;

    const panjang = parseFloat(document.getElementById('dim-panjang').value) || 0;
    const lebar   = parseFloat(document.getElementById('dim-lebar').value)   || 0;

    // Validate
    let hasError = false;
    if (panjang <= 0 && document.getElementById('dim-panjang').value !== '') {
        document.getElementById('err-panjang').classList.remove('hidden');
        hasError = true;
    } else {
        document.getElementById('err-panjang').classList.add('hidden');
    }
    if (lebar <= 0 && document.getElementById('dim-lebar').value !== '') {
        document.getElementById('err-lebar').classList.remove('hidden');
        hasError = true;
    } else {
        document.getElementById('err-lebar').classList.add('hidden');
    }

    if (panjang <= 0 || lebar <= 0) {
        document.getElementById('area-preview').textContent = '0 m²';
        return;
    }

    const area = panjang * lebar;
    document.getElementById('area-preview').textContent = area.toFixed(2) + ' m²';

    // Show skeleton
    document.getElementById('price-empty').classList.add('hidden');
    document.getElementById('price-breakdown').classList.add('hidden');
    document.getElementById('price-skeleton').classList.remove('hidden');

    calcTimer = setTimeout(() => {
        const materialExtra = parseInt(document.getElementById('material-select').value) || 0;
        const lampRadio = document.querySelector('input[name="lamp-type"]:checked');
        const lampPrice = lampRadio ? parseInt(lampRadio.dataset.price) : 0;

        const materialCost = (selectedTypePrice + materialExtra) * area;
        const lampCost     = lampPrice;
        const designCost   = 250000;
        const installCost  = 300000;
        const shippingCost = 100000;

        const subtotal = materialCost + lampCost + designCost + installCost + shippingCost;
        const discount = applyDiscount(subtotal, appliedDiscount);
        const total    = subtotal - discount;

        // Update UI
        document.getElementById('bd-area').textContent     = area.toFixed(2);
        document.getElementById('bd-material').textContent = formatRupiah(materialCost);
        document.getElementById('bd-lamp').textContent     = formatRupiah(lampCost);
        document.getElementById('bd-total').textContent    = formatRupiah(total);

        if (discount > 0) {
            document.getElementById('discount-row').classList.remove('hidden');
            document.getElementById('bd-discount').textContent = '-' + formatRupiah(discount);
        } else {
            document.getElementById('discount-row').classList.add('hidden');
        }

        document.getElementById('price-skeleton').classList.add('hidden');
        document.getElementById('price-breakdown').classList.remove('hidden');
    }, 400);
}

function formatRupiah(amount) {
    return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
}

function applyDiscount(subtotal, promoData) {
    if (!promoData) return 0;
    let discount = 0;
    if (promoData.type === 'percent') {
        discount = subtotal * (promoData.value / 100);
    } else {
        discount = promoData.value;
    }
    return Math.min(discount, subtotal);
}

function applyPromo() {
    const code = document.getElementById('promo-input').value.trim().toUpperCase();
    const resultEl = document.getElementById('promo-result');

    if (!code) {
        resultEl.innerHTML = '<p class="text-xs text-red-500"><i class="fas fa-exclamation-circle mr-1"></i>Masukkan kode promo terlebih dahulu.</p>';
        resultEl.classList.remove('hidden');
        return;
    }

    if (PROMO_CODES[code]) {
        const promo = PROMO_CODES[code];
        appliedDiscount = promo;
        const desc = promo.type === 'percent' ? `Diskon ${promo.value}%` : `Potongan ${formatRupiah(promo.value)}`;
        resultEl.innerHTML = `<div class="flex items-center gap-2 bg-green-50 border border-green-200 rounded-xl px-3 py-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <span class="text-xs text-green-700 font-semibold">Kode berhasil! ${desc} diterapkan.</span>
        </div>`;
        resultEl.classList.remove('hidden');
        calculatePrice();
    } else {
        appliedDiscount = 0;
        resultEl.innerHTML = `<div class="flex items-center gap-2 bg-red-50 border border-red-200 rounded-xl px-3 py-2">
            <i class="fas fa-times-circle text-red-500"></i>
            <span class="text-xs text-red-700 font-semibold">Kode promo tidak valid atau sudah kadaluarsa.</span>
        </div>`;
        resultEl.classList.remove('hidden');
    }
}

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    document.getElementById('file-name').textContent = file.name;
    document.getElementById('file-preview').classList.remove('hidden');
    document.getElementById('drop-zone').classList.add('border-green-400', 'bg-green-50');
}

function handleFileDrop(event) {
    event.preventDefault();
    document.getElementById('drop-zone').classList.remove('border-blue-500', 'bg-blue-50');
    const file = event.dataTransfer.files[0];
    if (!file) return;
    document.getElementById('file-name').textContent = file.name;
    document.getElementById('file-preview').classList.remove('hidden');
    document.getElementById('drop-zone').classList.add('border-green-400', 'bg-green-50');
}

function removeFile() {
    document.getElementById('file-input').value = '';
    document.getElementById('file-preview').classList.add('hidden');
    document.getElementById('drop-zone').classList.remove('border-green-400', 'bg-green-50');
}
</script>
@endpush
