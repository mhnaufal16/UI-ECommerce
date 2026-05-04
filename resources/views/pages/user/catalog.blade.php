@extends('layouts.app')

@section('title', 'Katalog Produk - AP Kreasi')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-slate-900 to-blue-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-slate-400 mb-4" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-white font-medium">Katalog Produk</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">Katalog Produk</h1>
        <p class="text-slate-300">Temukan produk reklame dan signage yang sesuai kebutuhan bisnis Anda.</p>
    </div>
</div>

{{-- Main Content --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Filter & Search Bar --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-8">
        {{-- Category Filters --}}
        <div class="flex flex-wrap gap-2 flex-1" id="filter-buttons">
            @foreach(['Semua' => 'semua', 'Neon Box' => 'neon-box', 'Reklame' => 'reklame', 'Letter Timbul' => 'letter-timbul', 'Baliho' => 'baliho', 'Signage' => 'signage'] as $label => $val)
            <button
                onclick="filterCategory('{{ $val }}')"
                data-filter="{{ $val }}"
                class="filter-btn px-4 py-2 text-sm font-semibold rounded-xl border transition-all duration-200 {{ $val === 'semua' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600' }}">
                {{ $label }}
            </button>
            @endforeach
        </div>
        {{-- Search --}}
        <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 w-full sm:w-64 shadow-sm">
            <i class="fas fa-search text-gray-400 text-sm"></i>
            <input type="text" id="search-input" placeholder="Cari produk..." oninput="searchProducts()"
                   class="bg-transparent text-sm text-gray-700 outline-none w-full placeholder-gray-400"
                   aria-label="Cari produk">
        </div>
    </div>

    {{-- Product Grid --}}
    @php
    $products = [
        ['name' => 'Neon Box LED Akrilik', 'category' => 'neon-box', 'cat_label' => 'Neon Box',
         'desc' => 'Neon box dengan material akrilik premium dan lampu LED hemat energi. Cocok untuk toko, restoran, dan klinik.',
         'price' => 'Rp 750.000/m²', 'gradient' => 'from-blue-400 to-blue-600', 'icon' => 'fa-lightbulb'],
        ['name' => 'Reklame Akrilik Custom', 'category' => 'reklame', 'cat_label' => 'Reklame',
         'desc' => 'Reklame akrilik dengan finishing glossy atau matte. Tahan cuaca dan UV untuk penggunaan outdoor.',
         'price' => 'Rp 500.000/m²', 'gradient' => 'from-purple-400 to-purple-600', 'icon' => 'fa-sign'],
        ['name' => 'Letter Timbul Stainless', 'category' => 'letter-timbul', 'cat_label' => 'Letter Timbul',
         'desc' => 'Huruf timbul stainless steel 304 dengan finishing mirror atau hairline. Elegan untuk fasad gedung.',
         'price' => 'Rp 200.000/huruf', 'gradient' => 'from-gray-400 to-gray-600', 'icon' => 'fa-font'],
        ['name' => 'Baliho Flexi Digital', 'category' => 'baliho', 'cat_label' => 'Baliho',
         'desc' => 'Baliho flexi printing resolusi tinggi dengan rangka besi galvanis. Ukuran custom sesuai kebutuhan.',
         'price' => 'Rp 30.000/m²', 'gradient' => 'from-green-400 to-emerald-600', 'icon' => 'fa-image'],
        ['name' => 'Signage Direktori Kantor', 'category' => 'signage', 'cat_label' => 'Signage',
         'desc' => 'Signage direktori dan petunjuk arah untuk gedung perkantoran. Material akrilik atau aluminium composite.',
         'price' => 'Rp 350.000/m²', 'gradient' => 'from-cyan-400 to-cyan-600', 'icon' => 'fa-building'],
        ['name' => 'Neon Box Galvanis', 'category' => 'neon-box', 'cat_label' => 'Neon Box',
         'desc' => 'Neon box dengan rangka galvanis kokoh dan tahan karat. Ideal untuk area outdoor dengan cuaca ekstrem.',
         'price' => 'Rp 650.000/m²', 'gradient' => 'from-indigo-400 to-blue-500', 'icon' => 'fa-lightbulb'],
        ['name' => 'Reklame Stainless Premium', 'category' => 'reklame', 'cat_label' => 'Reklame',
         'desc' => 'Reklame stainless steel premium dengan lampu backlit LED. Tampilan mewah untuk brand premium.',
         'price' => 'Rp 850.000/m²', 'gradient' => 'from-orange-400 to-red-500', 'icon' => 'fa-sign'],
        ['name' => 'Letter Timbul Akrilik', 'category' => 'letter-timbul', 'cat_label' => 'Letter Timbul',
         'desc' => 'Huruf timbul akrilik warna-warni dengan pilihan backlit LED. Cocok untuk interior toko dan kantor.',
         'price' => 'Rp 150.000/huruf', 'gradient' => 'from-pink-400 to-rose-500', 'icon' => 'fa-font'],
    ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="product-grid">
        @foreach($products as $product)
        <div class="product-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group"
             data-category="{{ $product['category'] }}"
             data-name="{{ strtolower($product['name']) }}">
            {{-- Image Placeholder --}}
            <div class="relative h-44 bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center overflow-hidden">
                <i class="fas {{ $product['icon'] }} text-white/30 text-6xl group-hover:scale-110 transition-transform duration-300"></i>
                <div class="absolute top-3 left-3">
                    <span class="text-xs font-bold text-white bg-black/30 backdrop-blur-sm px-2.5 py-1 rounded-full">
                        {{ $product['cat_label'] }}
                    </span>
                </div>
            </div>
            {{-- Content --}}
            <div class="p-5">
                <h3 class="font-bold text-gray-900 text-base mb-1.5">{{ $product['name'] }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-3 line-clamp-2">{{ $product['desc'] }}</p>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <p class="font-bold text-blue-600 text-base">{{ $product['price'] }}</p>
                    </div>
                    <x-badge status="{{ $product['category'] === 'neon-box' || $product['category'] === 'reklame' ? 'aktif' : 'aktif' }}" />
                </div>
                <a href="{{ url('/kalkulator') }}"
                   class="block w-full text-center py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-sm font-semibold rounded-xl transition-all duration-200">
                    <i class="fas fa-calculator mr-1.5"></i>Custom Sekarang
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Empty State (hidden by default) --}}
    <div id="empty-state" class="hidden">
        <x-empty-state
            icon="fa-search"
            title="Produk tidak ditemukan"
            message="Tidak ada produk yang sesuai dengan filter atau pencarian Anda. Coba kategori lain."
        />
    </div>

    {{-- Load More --}}
    <div class="text-center mt-10" id="load-more-btn">
        <button onclick="loadMore()"
                class="inline-flex items-center gap-2 px-8 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-200">
            <i class="fas fa-plus"></i> Muat Lebih Banyak
        </button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let activeFilter = 'semua';

    function filterCategory(cat) {
        activeFilter = cat;

        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(btn => {
            const isActive = btn.dataset.filter === cat;
            btn.className = `filter-btn px-4 py-2 text-sm font-semibold rounded-xl border transition-all duration-200 ${
                isActive
                    ? 'bg-blue-600 text-white border-blue-600'
                    : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600'
            }`;
        });

        applyFilters();
    }

    function searchProducts() {
        applyFilters();
    }

    function applyFilters() {
        const searchVal = document.getElementById('search-input').value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const matchCat = activeFilter === 'semua' || card.dataset.category === activeFilter;
            const matchSearch = card.dataset.name.includes(searchVal);
            const show = matchCat && matchSearch;
            card.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        const emptyState = document.getElementById('empty-state');
        const loadMore = document.getElementById('load-more-btn');
        emptyState.classList.toggle('hidden', visibleCount > 0);
        loadMore.classList.toggle('hidden', visibleCount === 0);
    }

    function loadMore() {
        // Simulate load more - in real app this would fetch more products
        const btn = document.getElementById('load-more-btn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memuat...';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-check mr-2"></i> Semua produk telah ditampilkan';
            btn.disabled = true;
            btn.className = 'inline-flex items-center gap-2 px-8 py-3 border-2 border-gray-300 text-gray-400 font-semibold rounded-xl cursor-not-allowed';
        }, 1200);
    }
</script>
@endpush
