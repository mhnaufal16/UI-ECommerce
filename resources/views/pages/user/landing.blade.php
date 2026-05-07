@extends('layouts.app')

@section('title', 'AP Kreasi - Toko Reklame & Neon Box Online')

@push('styles')
<style>
    /* Banner Slider */
    .banner-slide { display: none; }
    .banner-slide.active { display: flex; }

    /* Product card hover overlay */
    .product-card .hover-overlay {
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .product-card:hover .hover-overlay { opacity: 1; }
    .product-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .product-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px rgba(0,0,0,0.12); }

    /* Category pill active */
    .cat-pill.active {
        background-color: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }

    /* Dot nav */
    .dot { transition: all 0.3s ease; }
    .dot.active { background-color: #ffffff; width: 24px; border-radius: 4px; }

    /* Voucher copy feedback */
    .copy-btn.copied { background-color: #16a34a !important; }

    /* Scrollable category row */
    .cat-scroll::-webkit-scrollbar { height: 0; }

    /* Dot pattern background */
    .dot-pattern {
        background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 20px 20px;
    }
</style>
@endpush

@section('content')

{{-- ============================================================
     SECTION 1: PROMO BANNER SLIDER
     ============================================================ --}}
<section class="relative overflow-hidden bg-gray-900" aria-label="Promo Banner">
    {{-- Slides --}}
    <div class="relative h-[180px] sm:h-[240px] md:h-[280px]">

        {{-- Slide 1 --}}
        <div class="banner-slide active absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 items-center justify-between px-6 sm:px-12 md:px-20">
            {{-- Decorative circles --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex-1">
                <span class="inline-block bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">
                    <i class="fas fa-tag mr-1"></i>HEMAT 15%
                </span>
                <h2 class="text-white font-extrabold text-xl sm:text-3xl md:text-4xl leading-tight mb-2">
                    PROMO AKHIR TAHUN
                </h2>
                <p class="text-blue-100 text-sm sm:text-base mb-4">Diskon 15% untuk semua Neon Box — Terbatas!</p>
                <a href="{{ url('/produk') }}" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow-lg">
                    Klaim Promo <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="relative z-10 hidden sm:flex items-center justify-center w-32 md:w-48">
                <div class="w-24 h-24 md:w-36 md:h-36 bg-white/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-lightbulb text-yellow-300 text-5xl md:text-7xl drop-shadow-lg"></i>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="banner-slide absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 items-center justify-between px-6 sm:px-12 md:px-20">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex-1">
                <span class="inline-block bg-white text-purple-700 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">
                    <i class="fas fa-gift mr-1"></i>FREE DESIGN
                </span>
                <h2 class="text-white font-extrabold text-xl sm:text-3xl md:text-4xl leading-tight mb-2">
                    GRATIS DESAIN
                </h2>
                <p class="text-purple-100 text-sm sm:text-base mb-4">Untuk order pertama Anda — Desain profesional tanpa biaya tambahan</p>
                <a href="{{ url('/kalkulator') }}" class="inline-flex items-center gap-2 bg-white text-purple-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-purple-50 transition-colors shadow-lg">
                    Order Sekarang <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="relative z-10 hidden sm:flex items-center justify-center w-32 md:w-48">
                <div class="w-24 h-24 md:w-36 md:h-36 bg-white/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-paint-brush text-white text-5xl md:text-7xl drop-shadow-lg"></i>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="banner-slide absolute inset-0 bg-gradient-to-r from-green-600 to-teal-600 items-center justify-between px-6 sm:px-12 md:px-20">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex-1">
                <span class="inline-block bg-yellow-400 text-green-900 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">
                    <i class="fas fa-star mr-1"></i>HARGA TERBAIK
                </span>
                <h2 class="text-white font-extrabold text-xl sm:text-3xl md:text-4xl leading-tight mb-2">
                    NEON BOX MULAI<br class="hidden sm:block"> Rp 750.000/m²
                </h2>
                <p class="text-green-100 text-sm sm:text-base mb-4">Kualitas Premium, Harga Terjangkau — Garansi 1 Tahun</p>
                <a href="{{ url('/produk') }}" class="inline-flex items-center gap-2 bg-white text-green-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-green-50 transition-colors shadow-lg">
                    Lihat Produk <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="relative z-10 hidden sm:flex items-center justify-center w-32 md:w-48">
                <div class="w-24 h-24 md:w-36 md:h-36 bg-white/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-store text-white text-5xl md:text-7xl drop-shadow-lg"></i>
                </div>
            </div>
        </div>

        {{-- Prev / Next Arrows --}}
        <button id="banner-prev" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 bg-white/20 hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-colors backdrop-blur-sm" aria-label="Previous slide">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
        <button id="banner-next" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 bg-white/20 hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-colors backdrop-blur-sm" aria-label="Next slide">
            <i class="fas fa-chevron-right text-sm"></i>
        </button>
    </div>

    {{-- Dot Navigation --}}
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
        <button class="dot active w-6 h-2 bg-white/60 rounded-full" data-slide="0" aria-label="Slide 1"></button>
        <button class="dot w-2 h-2 bg-white/40 rounded-full" data-slide="1" aria-label="Slide 2"></button>
        <button class="dot w-2 h-2 bg-white/40 rounded-full" data-slide="2" aria-label="Slide 3"></button>
    </div>
</section>

{{-- ============================================================
     SECTION 2: QUICK STATS BAR
     ============================================================ --}}
<section class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-0 divide-x divide-gray-100">
            <div class="flex items-center gap-3 px-4 py-2 justify-center">
                <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-rocket text-blue-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm leading-tight">Produksi 7–14 Hari</p>
                    <p class="text-xs text-gray-400">Pengerjaan cepat</p>
                </div>
            </div>
            <div class="flex items-center gap-3 px-4 py-2 justify-center">
                <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-alt text-green-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm leading-tight">Garansi 1 Tahun</p>
                    <p class="text-xs text-gray-400">Kualitas terjamin</p>
                </div>
            </div>
            <div class="flex items-center gap-3 px-4 py-2 justify-center">
                <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-truck text-purple-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm leading-tight">Kirim Seluruh Indonesia</p>
                    <p class="text-xs text-gray-400">Pengiriman terpercaya</p>
                </div>
            </div>
            <div class="flex items-center gap-3 px-4 py-2 justify-center">
                <div class="w-9 h-9 bg-yellow-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-star text-yellow-500 text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm leading-tight">4.9/5 Rating</p>
                    <p class="text-xs text-gray-400">200+ Ulasan</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 3: CATEGORY QUICK LINKS
     ============================================================ --}}
<section class="bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-bold text-gray-800">Kategori Produk</h2>
        </div>
        <div class="cat-scroll flex gap-3 overflow-x-auto pb-2">
            <button class="cat-pill active flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-blue-400 hover:text-blue-600 transition-all" data-cat="Semua">
                <i class="fas fa-th-large text-xs"></i> Semua
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-blue-400 hover:text-blue-600 transition-all" data-cat="Neon Box">
                <i class="fas fa-lightbulb text-xs text-blue-500"></i> Neon Box
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-purple-400 hover:text-purple-600 transition-all" data-cat="Reklame">
                <i class="fas fa-sign text-xs text-purple-500"></i> Reklame
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-gray-400 hover:text-gray-700 transition-all" data-cat="Letter Timbul">
                <i class="fas fa-font text-xs text-gray-500"></i> Letter Timbul
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-green-400 hover:text-green-600 transition-all" data-cat="Baliho">
                <i class="fas fa-image text-xs text-green-500"></i> Baliho
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-cyan-400 hover:text-cyan-600 transition-all" data-cat="Signage">
                <i class="fas fa-building text-xs text-cyan-500"></i> Signage
            </button>
            <button class="cat-pill flex-shrink-0 flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-600 hover:border-red-400 hover:text-red-600 transition-all" data-cat="Branding">
                <i class="fas fa-car text-xs text-red-500"></i> Branding
            </button>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 4: PROMO VOUCHER BANNER
     ============================================================ --}}
<section class="py-4 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                {{-- Left --}}
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-fire text-white text-2xl"></i>
                    </div>
                    <div>
                        <span class="inline-block bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full mb-1 uppercase">PROMO SPESIAL</span>
                        <p class="text-white font-semibold text-sm sm:text-base">Gunakan kode voucher untuk diskon eksklusif!</p>
                        <p class="text-orange-100 text-xs mt-0.5">Berlaku untuk semua produk · Minimal order Rp 500.000</p>
                    </div>
                </div>
                {{-- Right: Voucher codes --}}
                <div class="flex flex-wrap gap-3">
                    {{-- Voucher 1 --}}
                    <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-xl px-3 py-2">
                        <div>
                            <p class="text-orange-100 text-xs">Diskon 10%</p>
                            <code class="text-white font-bold text-base tracking-widest font-mono">HEMAT10</code>
                        </div>
                        <button
                            class="copy-btn ml-2 bg-white text-orange-600 font-semibold text-xs px-3 py-1.5 rounded-lg hover:bg-orange-50 transition-colors"
                            data-code="HEMAT10"
                            aria-label="Salin kode HEMAT10">
                            Salin
                        </button>
                    </div>
                    {{-- Voucher 2 --}}
                    <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-xl px-3 py-2">
                        <div>
                            <p class="text-orange-100 text-xs">Gratis Ongkir</p>
                            <code class="text-white font-bold text-base tracking-widest font-mono">GRATIS50</code>
                        </div>
                        <button
                            class="copy-btn ml-2 bg-white text-orange-600 font-semibold text-xs px-3 py-1.5 rounded-lg hover:bg-orange-50 transition-colors"
                            data-code="GRATIS50"
                            aria-label="Salin kode GRATIS50">
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 5: PRODUK UNGGULAN (Featured Products)
     ============================================================ --}}
@php
$products = [
    [
        'id'       => 1,
        'name'     => 'Neon Box LED Akrilik',
        'category' => 'Neon Box',
        'price'    => 'Mulai Rp 750.000/m²',
        'gradient' => 'from-blue-400 to-blue-600',
        'icon'     => 'fa-lightbulb',
        'image'    => 'https://images.unsplash.com/photo-1600298881974-6be191ceeda1?w=500&q=80',
        'badge'    => 'TERLARIS',
        'badge_color' => 'bg-red-500',
        'rating'   => '4.9',
        'reviews'  => 128,
        'desc'     => 'Neon box LED akrilik custom, terang & hemat energi. Cocok untuk toko, restoran, dan kantor.',
    ],
    [
        'id'       => 2,
        'name'     => 'Reklame Akrilik Custom',
        'category' => 'Reklame',
        'price'    => 'Mulai Rp 500.000/m²',
        'gradient' => 'from-purple-400 to-purple-600',
        'icon'     => 'fa-sign',
        'image'    => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=500&q=80',
        'badge'    => 'POPULER',
        'badge_color' => 'bg-purple-600',
        'rating'   => '4.8',
        'reviews'  => 95,
        'desc'     => 'Reklame akrilik full color, tahan cuaca, cocok untuk outdoor maupun indoor.',
    ],
    [
        'id'       => 3,
        'name'     => 'Letter Timbul Stainless',
        'category' => 'Letter Timbul',
        'price'    => 'Mulai Rp 200.000/huruf',
        'gradient' => 'from-gray-400 to-gray-600',
        'icon'     => 'fa-font',
        'image'    => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=500&q=80',
        'badge'    => null,
        'badge_color' => '',
        'rating'   => '4.7',
        'reviews'  => 67,
        'desc'     => 'Letter timbul stainless steel premium, finishing mirror atau hairline, tahan lama.',
    ],
    [
        'id'       => 4,
        'name'     => 'Neon Box Galvanis',
        'category' => 'Neon Box',
        'price'    => 'Mulai Rp 650.000/m²',
        'gradient' => 'from-indigo-400 to-indigo-600',
        'icon'     => 'fa-lightbulb',
        'image'    => 'https://images.unsplash.com/photo-1551522435-a13afa10f103?w=500&q=80',
        'badge'    => null,
        'badge_color' => '',
        'rating'   => '4.8',
        'reviews'  => 43,
        'desc'     => 'Neon box rangka galvanis anti karat, cocok untuk area outdoor dengan cuaca ekstrem.',
    ],
    [
        'id'       => 5,
        'name'     => 'Baliho Flexi Premium',
        'category' => 'Baliho',
        'price'    => 'Mulai Rp 30.000/m²',
        'gradient' => 'from-yellow-400 to-orange-500',
        'icon'     => 'fa-image',
        'image'    => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80',
        'badge'    => 'PROMO',
        'badge_color' => 'bg-orange-500',
        'rating'   => '4.6',
        'reviews'  => 112,
        'desc'     => 'Baliho flexi banner resolusi tinggi, warna tajam, tahan sinar UV dan hujan.',
    ],
    [
        'id'       => 6,
        'name'     => 'Signage Direktori',
        'category' => 'Signage',
        'price'    => 'Mulai Rp 350.000/unit',
        'gradient' => 'from-cyan-400 to-cyan-600',
        'icon'     => 'fa-building',
        'image'    => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=500&q=80',
        'badge'    => 'BARU',
        'badge_color' => 'bg-green-500',
        'rating'   => '4.9',
        'reviews'  => 21,
        'desc'     => 'Signage direktori gedung dan perkantoran, desain modern dan elegan.',
    ],
    [
        'id'       => 7,
        'name'     => 'Letter Timbul Akrilik',
        'category' => 'Letter Timbul',
        'price'    => 'Mulai Rp 150.000/huruf',
        'gradient' => 'from-pink-400 to-pink-600',
        'icon'     => 'fa-font',
        'image'    => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=500&q=80',
        'badge'    => null,
        'badge_color' => '',
        'rating'   => '4.7',
        'reviews'  => 38,
        'desc'     => 'Letter timbul akrilik warna-warni, ringan dan mudah dipasang di berbagai permukaan.',
    ],
    [
        'id'       => 8,
        'name'     => 'Reklame Galvanis Outdoor',
        'category' => 'Reklame',
        'price'    => 'Mulai Rp 600.000/m²',
        'gradient' => 'from-green-400 to-green-600',
        'icon'     => 'fa-sign',
        'image'    => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=500&q=80',
        'badge'    => null,
        'badge_color' => '',
        'rating'   => '4.8',
        'reviews'  => 56,
        'desc'     => 'Reklame galvanis outdoor kokoh, ideal untuk papan nama toko dan billboard.',
    ],
];
@endphp

<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Produk Unggulan</h2>
                <p class="text-sm text-gray-500 mt-0.5">Pilihan terbaik dari pelanggan kami</p>
            </div>
            <a href="{{ url('/produk') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        {{-- Product Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group cursor-pointer" data-category="{{ $product['category'] }}">
                {{-- Product Image --}}
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ $product['image'] }}" 
                         alt="{{ $product['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         loading="lazy"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center\'><i class=\'fas {{ $product['icon'] }} text-white/80 text-5xl\'></i></div>';">
                    {{-- Badge top-left --}}
                    @if($product['badge'])
                    <span class="absolute top-2 left-2 {{ $product['badge_color'] }} text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-lg">
                        {{ $product['badge'] }}
                    </span>
                    @endif
                    {{-- Category badge top-right --}}
                    <span class="absolute top-2 right-2 bg-black/40 backdrop-blur-sm text-white text-xs px-2 py-0.5 rounded-full border border-white/20">
                        {{ $product['category'] }}
                    </span>
                    {{-- Hover overlay --}}
                    <div class="hover-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-center justify-center">
                        <a href="{{ url('/kalkulator') }}" class="bg-white text-gray-800 font-semibold text-sm px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors shadow-lg transform translate-y-2 group-hover:translate-y-0">
                            <i class="fas fa-calculator mr-1.5 text-blue-600"></i>Hitung Harga
                        </a>
                    </div>
                </div>
                {{-- Card Body --}}
                <div class="p-3">
                    <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover:text-blue-600 transition-colors">{{ $product['name'] }}</h3>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-2 leading-relaxed">{{ $product['desc'] }}</p>
                    <p class="text-blue-600 font-bold text-sm mb-2">{{ $product['price'] }}</p>
                    <div class="flex items-center gap-1 mb-3">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="text-xs font-semibold text-gray-700">{{ $product['rating'] }}</span>
                        <span class="text-xs text-gray-400">({{ $product['reviews'] }})</span>
                    </div>
                    <a href="{{ url('/kalkulator') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs py-2 rounded-xl transition-colors shadow-sm hover:shadow-md">
                        Custom Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 6: BANNER KALKULATOR (CTA Strip)
     ============================================================ --}}
<section class="py-10 bg-gradient-to-r from-slate-800 to-blue-900 dot-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            {{-- Left: Text --}}
            <div class="text-center md:text-left">
                <span class="inline-block bg-blue-500/30 text-blue-200 text-xs font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">
                    <i class="fas fa-calculator mr-1"></i>Kalkulator Harga
                </span>
                <h2 class="text-white font-extrabold text-2xl sm:text-3xl mb-3 leading-tight">
                    Hitung Harga Sekarang
                </h2>
                <p class="text-blue-200 text-sm sm:text-base max-w-md">
                    Masukkan ukuran dan spesifikasi, dapatkan estimasi harga instan tanpa perlu menunggu.
                </p>
                <div class="flex flex-wrap gap-3 mt-5 justify-center md:justify-start">
                    <a href="{{ url('/kalkulator') }}" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-400 text-white font-semibold px-6 py-3 rounded-xl transition-colors shadow-lg">
                        <i class="fas fa-calculator"></i> Buka Kalkulator
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl transition-colors border border-white/20">
                        <i class="fab fa-whatsapp text-green-400"></i> Tanya via WA
                    </a>
                </div>
            </div>
            {{-- Right: Mini Calculator Card --}}
            <div class="w-full md:w-auto flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-2xl p-5 w-full md:w-72">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calculator text-white text-sm"></i>
                        </div>
                        <span class="font-bold text-gray-800 text-sm">Estimasi Harga Cepat</span>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Panjang (meter)</label>
                            <input type="number" placeholder="Contoh: 2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400" aria-label="Panjang dalam meter">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Lebar (meter)</label>
                            <input type="number" placeholder="Contoh: 1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400" aria-label="Lebar dalam meter">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Produk</label>
                            <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400" aria-label="Pilih jenis produk">
                                <option>Neon Box LED</option>
                                <option>Reklame Akrilik</option>
                                <option>Letter Timbul</option>
                                <option>Baliho</option>
                            </select>
                        </div>
                        <a href="{{ url('/kalkulator') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm">
                            <i class="fas fa-calculator mr-1.5"></i>Hitung Sekarang
                        </a>
                    </div>
                    <p class="text-xs text-gray-400 text-center mt-3">Estimasi tidak mengikat · Konsultasi gratis</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 7: PROMO CARDS (2 side-by-side)
     ============================================================ --}}
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {{-- Card 1: Gratis Ongkir --}}
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-6 flex items-center gap-5 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-truck text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg leading-tight">Gratis Ongkir</h3>
                    <p class="text-green-100 text-sm mt-1">Untuk order di atas Rp 2.000.000 ke area Jawa. Hemat biaya pengiriman!</p>
                    <a href="{{ url('/produk') }}" class="inline-flex items-center gap-1 text-white font-semibold text-xs mt-2 hover:underline">
                        Pelajari syarat <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            {{-- Card 2: Konsultasi Gratis --}}
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-6 flex items-center gap-5 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-comments text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg leading-tight">Konsultasi Gratis</h3>
                    <p class="text-blue-100 text-sm mt-1">Chat langsung dengan tim desainer kami via WhatsApp. Respon cepat!</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-1 text-white font-semibold text-xs mt-2 hover:underline">
                        Chat sekarang <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 8: SEMUA PRODUK (All Products Grid with Filter)
     ============================================================ --}}
<section class="py-10 bg-white" id="semua-produk">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Semua Produk</h2>
                <p class="text-sm text-gray-500 mt-0.5">Temukan produk yang sesuai kebutuhan Anda</p>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="cat-scroll flex gap-2 overflow-x-auto pb-3 mb-6 border-b border-gray-100">
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-blue-600 text-white transition-all" data-filter="Semua">
                Semua
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Neon Box">
                Neon Box
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Reklame">
                Reklame
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Letter Timbul">
                Letter Timbul
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Baliho">
                Baliho
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Signage">
                Signage
            </button>
            <button class="all-filter-pill flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all" data-filter="Branding">
                Branding
            </button>
        </div>

        {{-- All Products Grid --}}
        <div id="all-products-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <div class="all-product-card product-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group cursor-pointer" data-category="{{ $product['category'] }}">
                {{-- Image Placeholder --}}
                <div class="relative aspect-square bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center overflow-hidden">
                    <i class="fas {{ $product['icon'] }} text-white/80 text-5xl"></i>
                    @if($product['badge'])
                    <span class="absolute top-2 left-2 {{ $product['badge_color'] }} text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $product['badge'] }}
                    </span>
                    @endif
                    <span class="absolute top-2 right-2 bg-black/30 backdrop-blur-sm text-white text-xs px-2 py-0.5 rounded-full">
                        {{ $product['category'] }}
                    </span>
                    <div class="hover-overlay absolute inset-0 bg-black/50 flex items-center justify-center">
                        <a href="{{ url('/kalkulator') }}" class="bg-white text-gray-800 font-semibold text-sm px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors shadow-lg">
                            <i class="fas fa-calculator mr-1.5 text-blue-600"></i>Hitung Harga
                        </a>
                    </div>
                </div>
                {{-- Card Body --}}
                <div class="p-3">
                    <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1">{{ $product['name'] }}</h3>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-2 leading-relaxed">{{ $product['desc'] }}</p>
                    <p class="text-blue-600 font-bold text-sm mb-2">{{ $product['price'] }}</p>
                    <div class="flex items-center gap-1 mb-3">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="text-xs font-semibold text-gray-700">{{ $product['rating'] }}</span>
                        <span class="text-xs text-gray-400">({{ $product['reviews'] }})</span>
                    </div>
                    <a href="{{ url('/kalkulator') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs py-2 rounded-xl transition-colors">
                        Custom Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Load More Button --}}
        <div class="text-center mt-8">
            <button id="load-more-btn" class="inline-flex items-center gap-2 px-8 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-xl hover:bg-blue-600 hover:text-white transition-all">
                <i class="fas fa-plus-circle"></i> Muat Lebih Banyak
            </button>
            <p id="load-more-msg" class="hidden text-sm text-gray-400 mt-3">Semua produk sudah ditampilkan.</p>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 9: TESTIMONI MINI
     ============================================================ --}}
<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-xl font-bold text-gray-900">Apa Kata Pelanggan Kami</h2>
            <p class="text-sm text-gray-500 mt-1">Kepuasan pelanggan adalah prioritas utama kami</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            {{-- Testimonial 1 --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 5; $i++)
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    "Neon box-nya bagus banget! Warna cerah, pemasangan rapi, dan selesai tepat waktu. Toko saya jadi lebih menarik sekarang."
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">BW</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Budi Wijaya</p>
                        <p class="text-xs text-gray-400">Pemilik Toko Elektronik, Surabaya</p>
                    </div>
                </div>
            </div>
            {{-- Testimonial 2 --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 5; $i++)
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    "Pelayanan sangat responsif, desain gratis sesuai keinginan. Letter timbul stainless-nya premium banget, worth it!"
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">SR</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Siti Rahayu</p>
                        <p class="text-xs text-gray-400">Manager Kafe, Malang</p>
                    </div>
                </div>
            </div>
            {{-- Testimonial 3 --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 4; $i++)
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    @endfor
                    <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    "Harga kompetitif, kualitas tidak mengecewakan. Sudah order 3x dan selalu puas. Rekomen banget untuk bisnis!"
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">AP</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Andi Pratama</p>
                        <p class="text-xs text-gray-400">Direktur CV Maju Jaya, Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 10: FOOTER CTA STRIP
     ============================================================ --}}
<section class="bg-gray-900 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-sign text-white text-2xl"></i>
        </div>
        <h2 class="text-white font-extrabold text-2xl sm:text-3xl mb-3">Siap Mulai Proyek Anda?</h2>
        <p class="text-gray-400 text-sm sm:text-base mb-7 max-w-lg mx-auto">
            Dapatkan estimasi harga instan atau konsultasikan kebutuhan Anda langsung dengan tim kami.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/kalkulator') }}" class="inline-flex items-center justify-center gap-2 bg-white text-gray-900 font-bold px-8 py-3.5 rounded-xl hover:bg-gray-100 transition-colors shadow-lg">
                <i class="fas fa-calculator text-blue-600"></i> Hitung Harga
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20konsultasi%20order" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold px-8 py-3.5 rounded-xl transition-colors shadow-lg">
                <i class="fab fa-whatsapp text-xl"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ============================================================
       BANNER SLIDER
       ============================================================ */
    const slides = document.querySelectorAll('.banner-slide');
    const dots   = document.querySelectorAll('.dot');
    let current  = 0;
    let autoTimer;

    function goToSlide(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function startAuto() {
        autoTimer = setInterval(() => goToSlide(current + 1), 4000);
    }

    function resetAuto() {
        clearInterval(autoTimer);
        startAuto();
    }

    document.getElementById('banner-prev').addEventListener('click', () => {
        goToSlide(current - 1);
        resetAuto();
    });

    document.getElementById('banner-next').addEventListener('click', () => {
        goToSlide(current + 1);
        resetAuto();
    });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            goToSlide(i);
            resetAuto();
        });
    });

    startAuto();

    /* ============================================================
       CATEGORY FILTER (top pills — filters both grids)
       ============================================================ */
    const catPills = document.querySelectorAll('.cat-pill');

    catPills.forEach(pill => {
        pill.addEventListener('click', () => {
            // Update active state on top pills
            catPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const cat = pill.dataset.cat;

            // Sync the all-products filter tabs
            syncAllFilterPills(cat);

            // Filter featured products (section 5)
            filterFeaturedProducts(cat);

            // Filter all products (section 8)
            filterAllProducts(cat);

            // Scroll to all products section
            if (cat !== 'Semua') {
                document.getElementById('semua-produk').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ============================================================
       ALL PRODUCTS FILTER TABS (section 8)
       ============================================================ */
    const allFilterPills = document.querySelectorAll('.all-filter-pill');

    allFilterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            const filter = pill.dataset.filter;
            syncAllFilterPills(filter);
            filterAllProducts(filter);

            // Also sync top category pills
            catPills.forEach(p => {
                p.classList.toggle('active', p.dataset.cat === filter);
            });

            filterFeaturedProducts(filter);
        });
    });

    function syncAllFilterPills(cat) {
        allFilterPills.forEach(p => {
            const isActive = p.dataset.filter === cat;
            p.classList.toggle('bg-blue-600', isActive);
            p.classList.toggle('text-white', isActive);
            p.classList.toggle('bg-gray-100', !isActive);
            p.classList.toggle('text-gray-600', !isActive);
        });
    }

    function filterFeaturedProducts(cat) {
        // Target featured product cards (those NOT in the all-products section)
        document.querySelectorAll('.product-card:not(.all-product-card)').forEach(card => {
            const show = cat === 'Semua' || card.dataset.category === cat;
            card.style.display = show ? '' : 'none';
        });
    }

    function filterAllProducts(cat) {
        document.querySelectorAll('.all-product-card').forEach(card => {
            const show = cat === 'Semua' || card.dataset.category === cat;
            card.style.display = show ? '' : 'none';
        });
    }

    /* ============================================================
       COPY VOUCHER CODE
       ============================================================ */
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const code = btn.dataset.code;
            navigator.clipboard.writeText(code).then(() => {
                const original = btn.textContent;
                btn.textContent = 'Tersalin!';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.textContent = original;
                    btn.classList.remove('copied');
                }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const ta = document.createElement('textarea');
                ta.value = code;
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                const original = btn.textContent;
                btn.textContent = 'Tersalin!';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.textContent = original;
                    btn.classList.remove('copied');
                }, 2000);
            });
        });
    });

    /* ============================================================
       LOAD MORE BUTTON
       ============================================================ */
    let loadMoreClicked = false;
    const loadMoreBtn = document.getElementById('load-more-btn');
    const loadMoreMsg = document.getElementById('load-more-msg');

    loadMoreBtn.addEventListener('click', () => {
        if (loadMoreClicked) return;
        loadMoreClicked = true;

        // Simulate loading state
        loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';
        loadMoreBtn.disabled = true;

        setTimeout(() => {
            loadMoreBtn.style.display = 'none';
            loadMoreMsg.classList.remove('hidden');
        }, 1200);
    });

})();
</script>
@endpush
