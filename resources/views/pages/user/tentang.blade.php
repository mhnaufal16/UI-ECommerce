@extends('layouts.app')

@section('title', 'Tentang Kami — AP Kreasi')

@push('styles')
<style>
    /* Portfolio hover overlay */
    .portfolio-item .portfolio-overlay {
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .portfolio-item:hover .portfolio-overlay {
        opacity: 1;
    }
    .portfolio-item {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .portfolio-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    /* Team card hover */
    .team-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.10);
    }

    /* Service card hover */
    .service-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(0,0,0,0.10);
    }

    /* Step connector line */
    .step-connector {
        position: absolute;
        top: 28px;
        left: calc(50% + 28px);
        right: calc(-50% + 28px);
        height: 2px;
        background: rgba(255,255,255,0.25);
    }
</style>
@endpush

@section('content')

{{-- ============================================================
     SECTION 1: PAGE HEADER
     ============================================================ --}}
<section class="relative bg-gradient-to-br from-slate-900 to-blue-900 overflow-hidden" style="min-height:200px;" aria-label="Header Tentang Kami">
    {{-- Decorative shapes --}}
    <div class="absolute top-0 right-0 w-80 h-80 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-56 h-56 bg-blue-500/10 rounded-full translate-y-1/2 pointer-events-none"></div>
    <div class="absolute top-1/2 left-0 w-40 h-40 bg-indigo-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 flex flex-col items-center text-center justify-center" style="min-height:200px;">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-300 mb-4" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs text-blue-500"></i>
            <span class="text-white font-medium">Tentang Kami</span>
        </nav>

        {{-- Title --}}
        <h1 class="text-white font-extrabold text-3xl sm:text-4xl leading-tight mb-3">
            Tentang Kami
        </h1>

        {{-- Subtitle --}}
        <p class="text-blue-200 text-base sm:text-lg">
            Kenali lebih dekat AP Kreasi
        </p>
    </div>
</section>

{{-- ============================================================
     SECTION 2: COMPANY INTRO
     ============================================================ --}}
<section class="py-20 bg-white" aria-label="Profil Perusahaan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- LEFT: Text --}}
            <div class="animate-on-scroll">
                {{-- Label --}}
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-4">Siapa Kami</span>

                {{-- Heading --}}
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight mb-6">
                    AP Kreasi — Spesialis Reklame &amp; Neon Box
                </h2>

                {{-- Paragraphs --}}
                <div class="space-y-4 text-gray-600 leading-relaxed text-base mb-8">
                    <p>AP Kreasi adalah perusahaan spesialis pembuatan reklame, neon box, dan signage custom yang berdiri sejak 2017. Kami melayani pelanggan dari berbagai kota di Indonesia dengan standar kualitas tinggi dan harga yang transparan.</p>
                    <p>Dengan pengalaman lebih dari 8 tahun dan lebih dari 500 proyek yang telah diselesaikan, kami memiliki tim profesional yang siap membantu Anda mewujudkan identitas visual bisnis yang kuat dan berkesan.</p>
                    <p>Kepuasan pelanggan adalah prioritas utama kami. Setiap produk dikerjakan dengan penuh dedikasi, menggunakan material premium, dan melalui proses quality control yang ketat sebelum dikirimkan.</p>
                </div>

                {{-- Achievement badges 2x2 --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- Badge 1 --}}
                    <div class="flex items-center gap-3 bg-blue-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg leading-none">500+</p>
                            <p class="text-xs text-gray-500 mt-0.5">Proyek Selesai</p>
                        </div>
                    </div>
                    {{-- Badge 2 --}}
                    <div class="flex items-center gap-3 bg-green-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users text-green-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg leading-none">200+</p>
                            <p class="text-xs text-gray-500 mt-0.5">Klien Puas</p>
                        </div>
                    </div>
                    {{-- Badge 3 --}}
                    <div class="flex items-center gap-3 bg-purple-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar-alt text-purple-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg leading-none">8+</p>
                            <p class="text-xs text-gray-500 mt-0.5">Tahun Pengalaman</p>
                        </div>
                    </div>
                    {{-- Badge 4 --}}
                    <div class="flex items-center gap-3 bg-yellow-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-star text-yellow-500 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg leading-none">4.9/5</p>
                            <p class="text-xs text-gray-500 mt-0.5">Rating</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Company stats card --}}
            <div class="animate-on-scroll">
                <div class="bg-slate-800 rounded-2xl p-8 shadow-2xl">
                    {{-- Logo area --}}
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-sign text-white text-2xl"></i>
                        </div>
                        <h3 class="text-white font-extrabold text-xl">AP Kreasi</h3>
                        <p class="text-slate-400 text-sm mt-1">Est. 2017 · Surabaya, Indonesia</p>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-700 mb-6"></div>

                    {{-- Stats rows --}}
                    <div class="space-y-4">
                        {{-- Row 1 --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clipboard-check text-blue-400 text-sm"></i>
                                </div>
                                <span class="text-slate-300 text-sm">Total Proyek</span>
                            </div>
                            <span class="text-white font-bold text-lg">500+</span>
                        </div>
                        {{-- Row 2 --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-green-400 text-sm"></i>
                                </div>
                                <span class="text-slate-300 text-sm">Klien Aktif</span>
                            </div>
                            <span class="text-white font-bold text-lg">200+</span>
                        </div>
                        {{-- Row 3 --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-purple-400 text-sm"></i>
                                </div>
                                <span class="text-slate-300 text-sm">Kota Terlayani</span>
                            </div>
                            <span class="text-white font-bold text-lg">50+</span>
                        </div>
                        {{-- Row 4 --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-orange-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-hard-hat text-orange-400 text-sm"></i>
                                </div>
                                <span class="text-slate-300 text-sm">Tim Profesional</span>
                            </div>
                            <span class="text-white font-bold text-lg">25+</span>
                        </div>
                    </div>

                    {{-- Bottom badge --}}
                    <div class="mt-6 pt-6 border-t border-slate-700 flex items-center justify-center gap-2">
                        <i class="fas fa-shield-alt text-green-400 text-sm"></i>
                        <span class="text-slate-400 text-xs">Terpercaya &amp; Berpengalaman sejak 2017</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 3: VISI & MISI
     ============================================================ --}}
<section class="py-20 bg-gray-50" aria-label="Visi dan Misi">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-12 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Nilai Perusahaan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Visi &amp; Misi Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Visi --}}
            <div class="animate-on-scroll bg-white rounded-2xl shadow-sm p-8 border-l-4 border-blue-500 hover:-translate-y-1 hover:shadow-md transition-all duration-200">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-eye text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Visi</h3>
                </div>
                <p class="text-gray-600 leading-relaxed text-base">
                    Menjadi perusahaan signage terpercaya dan terdepan di Indonesia yang dikenal atas kualitas, inovasi, dan kepuasan pelanggan.
                </p>
            </div>

            {{-- Misi --}}
            <div class="animate-on-scroll bg-white rounded-2xl shadow-sm p-8 border-l-4 border-purple-500 hover:-translate-y-1 hover:shadow-md transition-all duration-200">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bullseye text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Misi</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-purple-600 text-xs"></i>
                        </div>
                        <span class="text-gray-600 text-sm leading-relaxed">Menghadirkan produk signage berkualitas tinggi dengan harga yang terjangkau</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-purple-600 text-xs"></i>
                        </div>
                        <span class="text-gray-600 text-sm leading-relaxed">Memberikan pelayanan yang responsif dan profesional kepada setiap pelanggan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-purple-600 text-xs"></i>
                        </div>
                        <span class="text-gray-600 text-sm leading-relaxed">Terus berinovasi dalam desain dan teknologi produksi signage</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-purple-600 text-xs"></i>
                        </div>
                        <span class="text-gray-600 text-sm leading-relaxed">Membangun hubungan jangka panjang yang saling menguntungkan dengan pelanggan</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 4: LAYANAN
     ============================================================ --}}
<section class="py-20 bg-white" aria-label="Layanan Kami">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-12 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Apa yang Kami Tawarkan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3">Layanan Kami</h2>
            <p class="text-gray-500 text-base max-w-xl mx-auto">Solusi signage lengkap untuk semua kebutuhan bisnis Anda</p>
        </div>

        {{-- Service cards grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">

            {{-- 1. Reklame Custom --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-sign text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Reklame Custom</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Papan reklame akrilik, galvanis, dan stainless dengan desain custom.</p>
                <div class="flex items-center gap-1.5 text-blue-600">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 500.000/m²</span>
                </div>
            </div>

            {{-- 2. Neon Box --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-lightbulb text-yellow-500 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Neon Box</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Neon box LED modern, hemat energi, cahaya terang dan merata.</p>
                <div class="flex items-center gap-1.5 text-yellow-600">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 750.000/m²</span>
                </div>
            </div>

            {{-- 3. Letter Timbul --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-font text-purple-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Letter Timbul</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Huruf timbul 3D dari akrilik, stainless, atau galvanis premium.</p>
                <div class="flex items-center gap-1.5 text-purple-600">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 150.000/huruf</span>
                </div>
            </div>

            {{-- 4. Baliho & Spanduk --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-image text-green-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Baliho &amp; Spanduk</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Cetak baliho resolusi tinggi, tahan cuaca dan sinar UV.</p>
                <div class="flex items-center gap-1.5 text-green-600">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 25.000/m²</span>
                </div>
            </div>

            {{-- 5. Signage Kantor --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-building text-cyan-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Signage Kantor</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Papan nama, direktori, dan wayfinding system profesional.</p>
                <div class="flex items-center gap-1.5 text-cyan-600">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 300.000</span>
                </div>
            </div>

            {{-- 6. Branding Kendaraan --}}
            <div class="service-card animate-on-scroll bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-car text-red-500 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Branding Kendaraan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Stiker cutting dan wrapping kendaraan untuk promosi bergerak.</p>
                <div class="flex items-center gap-1.5 text-red-500">
                    <i class="fas fa-tag text-xs"></i>
                    <span class="text-xs font-semibold">Mulai Rp 200.000</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 5: PROSES KERJA
     ============================================================ --}}
<section class="py-20 bg-gradient-to-br from-blue-600 to-indigo-700 overflow-hidden" aria-label="Proses Kerja">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-14 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-200 mb-3">Bagaimana Kami Bekerja</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Proses Kerja Kami</h2>
        </div>

        {{-- Steps --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4">

            {{-- Step 01 --}}
            <div class="animate-on-scroll relative flex flex-col items-center text-center">
                {{-- Connector line (desktop only, not on last item) --}}
                <div class="step-connector hidden lg:block"></div>

                {{-- Number badge --}}
                <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center mb-4 shadow-lg z-10 relative">
                    <span class="text-yellow-900 font-extrabold text-sm">01</span>
                </div>
                {{-- Icon circle --}}
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-comments text-white text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Konsultasi</h3>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">Diskusikan kebutuhan dan konsep desain Anda bersama tim kami</p>
            </div>

            {{-- Step 02 --}}
            <div class="animate-on-scroll relative flex flex-col items-center text-center">
                <div class="step-connector hidden lg:block"></div>
                <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center mb-4 shadow-lg z-10 relative">
                    <span class="text-yellow-900 font-extrabold text-sm">02</span>
                </div>
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-pencil-ruler text-white text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Desain</h3>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">Tim desainer kami membuat mockup sesuai brief yang disepakati</p>
            </div>

            {{-- Step 03 --}}
            <div class="animate-on-scroll relative flex flex-col items-center text-center">
                <div class="step-connector hidden lg:block"></div>
                <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center mb-4 shadow-lg z-10 relative">
                    <span class="text-yellow-900 font-extrabold text-sm">03</span>
                </div>
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-industry text-white text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Produksi</h3>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">Pengerjaan menggunakan material premium dengan quality control ketat</p>
            </div>

            {{-- Step 04 --}}
            <div class="animate-on-scroll flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center mb-4 shadow-lg">
                    <span class="text-yellow-900 font-extrabold text-sm">04</span>
                </div>
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-truck text-white text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Pengiriman</h3>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">Pengiriman aman ke seluruh Indonesia dengan packaging khusus</p>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 6: TIM
     ============================================================ --}}
<section class="py-20 bg-white" aria-label="Tim Kami">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-12 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Orang-orang di Balik AP Kreasi</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3">Tim Kami</h2>
            <p class="text-gray-500 text-base">Profesional berpengalaman di bidangnya</p>
        </div>

        {{-- Team grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            {{-- Member 1: Andi Pratama --}}
            <div class="team-card animate-on-scroll bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-md">
                    <span class="text-white font-extrabold text-xl">AP</span>
                </div>
                <h3 class="font-bold text-gray-900 text-base leading-tight mb-1">Andi Pratama</h3>
                <p class="text-blue-600 text-xs font-semibold mb-3">Founder &amp; CEO</p>
                <p class="text-gray-500 text-xs leading-relaxed">Berpengalaman 10+ tahun di industri signage dan advertising</p>
            </div>

            {{-- Member 2: Budi Setiawan --}}
            <div class="team-card animate-on-scroll bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mb-4 shadow-md">
                    <span class="text-white font-extrabold text-xl">BS</span>
                </div>
                <h3 class="font-bold text-gray-900 text-base leading-tight mb-1">Budi Setiawan</h3>
                <p class="text-green-600 text-xs font-semibold mb-3">Head of Production</p>
                <p class="text-gray-500 text-xs leading-relaxed">Ahli dalam produksi neon box dan reklame berkualitas tinggi</p>
            </div>

            {{-- Member 3: Citra Dewi --}}
            <div class="team-card animate-on-scroll bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mb-4 shadow-md">
                    <span class="text-white font-extrabold text-xl">CD</span>
                </div>
                <h3 class="font-bold text-gray-900 text-base leading-tight mb-1">Citra Dewi</h3>
                <p class="text-purple-600 text-xs font-semibold mb-3">Lead Designer</p>
                <p class="text-gray-500 text-xs leading-relaxed">Desainer grafis berpengalaman dengan portofolio 300+ proyek</p>
            </div>

            {{-- Member 4: Doni Kusuma --}}
            <div class="team-card animate-on-scroll bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mb-4 shadow-md">
                    <span class="text-white font-extrabold text-xl">DK</span>
                </div>
                <h3 class="font-bold text-gray-900 text-base leading-tight mb-1">Doni Kusuma</h3>
                <p class="text-orange-600 text-xs font-semibold mb-3">Sales Manager</p>
                <p class="text-gray-500 text-xs leading-relaxed">Membantu pelanggan menemukan solusi signage terbaik</p>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 7: PORTFOLIO MINI
     ============================================================ --}}
<section class="py-20 bg-gray-50" aria-label="Portofolio">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-10 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Hasil Kerja Kami</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Sebagian Karya Kami</h2>
        </div>

        {{-- Portfolio grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

            {{-- Item 1 --}}
            <div class="portfolio-item animate-on-scroll relative rounded-2xl overflow-hidden aspect-square cursor-pointer">
                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-700 flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white/40 text-5xl"></i>
                </div>
                <div class="portfolio-overlay absolute inset-0 bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                    <p class="text-white font-bold text-sm leading-tight">Neon Box Toko Elektronik</p>
                    <p class="text-blue-200 text-xs mt-1">Neon Box</p>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="portfolio-item animate-on-scroll relative rounded-2xl overflow-hidden aspect-square cursor-pointer">
                <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-700 flex items-center justify-center">
                    <i class="fas fa-sign text-white/40 text-5xl"></i>
                </div>
                <div class="portfolio-overlay absolute inset-0 bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                    <p class="text-white font-bold text-sm leading-tight">Reklame Restoran Padang</p>
                    <p class="text-purple-200 text-xs mt-1">Reklame Custom</p>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="portfolio-item animate-on-scroll relative rounded-2xl overflow-hidden aspect-square cursor-pointer">
                <div class="w-full h-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center">
                    <i class="fas fa-font text-white/40 text-5xl"></i>
                </div>
                <div class="portfolio-overlay absolute inset-0 bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                    <p class="text-white font-bold text-sm leading-tight">Letter Timbul Kantor Notaris</p>
                    <p class="text-green-200 text-xs mt-1">Letter Timbul</p>
                </div>
            </div>

            {{-- Item 4 --}}
            <div class="portfolio-item animate-on-scroll relative rounded-2xl overflow-hidden aspect-square cursor-pointer">
                <div class="w-full h-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                    <i class="fas fa-building text-white/40 text-5xl"></i>
                </div>
                <div class="portfolio-overlay absolute inset-0 bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                    <p class="text-white font-bold text-sm leading-tight">Signage Gedung Perkantoran</p>
                    <p class="text-orange-200 text-xs mt-1">Signage Kantor</p>
                </div>
            </div>

        </div>

        {{-- CTA button --}}
        <div class="text-center animate-on-scroll">
            <a href="{{ url('/produk') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-md hover:shadow-lg">
                <i class="fas fa-th-large text-sm"></i>
                Lihat Semua Produk
            </a>
        </div>

    </div>
</section>

{{-- ============================================================
     SECTION 8: TESTIMONI
     ============================================================ --}}
<section class="py-20 bg-white" aria-label="Testimoni Pelanggan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-12 animate-on-scroll">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Ulasan Nyata</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Kata Pelanggan Kami</h2>
        </div>

        {{-- Testimonial cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Testimonial 1 --}}
            <div class="animate-on-scroll bg-gray-50 rounded-2xl p-6 border border-gray-100">
                {{-- Stars --}}
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                </div>
                {{-- Quote --}}
                <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">
                    "Neon box untuk toko saya hasilnya luar biasa! Kualitas sangat bagus, pengerjaan cepat, dan tim AP Kreasi sangat responsif. Pasti akan order lagi."
                </p>
                {{-- Author --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">RH</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Rizky Hidayat</p>
                        <p class="text-gray-400 text-xs">Pemilik Toko Elektronik, Surabaya</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="animate-on-scroll bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">
                    "Letter timbul stainless untuk kantor kami terlihat sangat profesional dan elegan. Harga transparan, tidak ada biaya tersembunyi. Sangat merekomendasikan!"
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">SW</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Sari Wulandari</p>
                        <p class="text-gray-400 text-xs">Direktur PT Maju Bersama, Jakarta</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="animate-on-scroll bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">
                    "Sudah 3 kali order reklame di AP Kreasi. Konsistensi kualitasnya terjaga, pengiriman selalu tepat waktu, dan packaging aman sampai tujuan. Top!"
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">FN</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Fajar Nugroho</p>
                        <p class="text-gray-400 text-xs">Owner Franchise Kuliner, Bandung</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 9: KONTAK / CTA
     ============================================================ --}}
<section class="py-20 bg-gray-900" id="kontak-tentang" aria-label="Kontak dan CTA">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            {{-- LEFT: Contact info --}}
            <div class="animate-on-scroll">
                <h2 class="text-white font-extrabold text-2xl sm:text-3xl mb-2">Hubungi Kami</h2>
                <p class="text-gray-400 text-sm mb-8">Kami siap membantu Anda menemukan solusi signage terbaik.</p>

                <ul class="space-y-5">
                    {{-- Address --}}
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-map-marker-alt text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5 uppercase tracking-wide font-medium">Alamat</p>
                            <p class="text-white text-sm leading-relaxed">Jl. Raya Industri No. 12, Surabaya, Jawa Timur</p>
                        </div>
                    </li>
                    {{-- Phone --}}
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5 uppercase tracking-wide font-medium">Telepon</p>
                            <p class="text-white text-sm">+62 812-3456-7890</p>
                        </div>
                    </li>
                    {{-- Email --}}
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5 uppercase tracking-wide font-medium">Email</p>
                            <p class="text-white text-sm">info@apkreasi.com</p>
                        </div>
                    </li>
                    {{-- Hours --}}
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5 uppercase tracking-wide font-medium">Jam Operasional</p>
                            <p class="text-white text-sm">Senin–Sabtu, 08.00–17.00 WIB</p>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- RIGHT: CTA --}}
            <div class="animate-on-scroll">
                <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700">
                    <h3 class="text-white font-extrabold text-xl mb-3">Siap Bekerja Sama?</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Ceritakan kebutuhan signage Anda kepada kami. Tim kami siap memberikan konsultasi gratis dan penawaran terbaik untuk bisnis Anda.
                    </p>

                    {{-- WhatsApp button (the ONLY CTA) --}}
                    <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20konsultasi%20mengenai%20kebutuhan%20signage%20saya"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4 rounded-xl transition-colors shadow-lg hover:shadow-green-900/30 w-full justify-center text-base">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Chat via WhatsApp
                    </a>

                    <p class="text-gray-500 text-xs text-center mt-4">
                        <i class="fas fa-lock text-xs mr-1"></i>
                        Konsultasi gratis · Tanpa komitmen
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
