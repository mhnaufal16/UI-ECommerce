<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AP Kreasi - Custom Order Reklame & Neon Box Profesional">
    <title>@yield('title', 'AP Kreasi - Reklame & Neon Box')</title>

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        .skeleton {
            background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 4px;
        }
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .navbar-scrolled {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 1px 20px rgba(0,0,0,0.08);
        }

        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }
        .btn-primary:active { transform: translateY(0); }

        #mobile-menu { transition: all 0.3s ease; }

        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .animate-on-scroll { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .animate-on-scroll.visible { opacity: 1; transform: translateY(0); }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- Navbar --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-blue-200 transition-shadow">
                        <i class="fas fa-sign text-white text-sm"></i>
                    </div>
                    <div class="leading-tight">
                        <span class="font-bold text-gray-900 text-base">AP Kreasi</span>
                        <p class="text-xs text-gray-400 -mt-0.5">Reklame & Neon Box</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ url('/') }}" class="px-4 py-2 text-sm font-medium {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-home mr-1.5 text-xs"></i>Home
                    </a>
                    <a href="{{ url('/produk') }}" class="px-4 py-2 text-sm font-medium {{ request()->is('produk') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-th-large mr-1.5 text-xs"></i>Produk
                    </a>
                    <a href="{{ url('/tentang') }}" class="px-4 py-2 text-sm font-medium {{ request()->is('tentang') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-info-circle mr-1.5 text-xs"></i>Tentang Kami
                    </a>
                    <a href="#kontak" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <i class="fas fa-envelope mr-1.5 text-xs"></i>Kontak
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ url('/masuk') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 border border-gray-200 hover:border-blue-300 rounded-lg transition-all duration-200">
                        <i class="fas fa-user mr-1.5 text-xs"></i>Masuk
                    </a>
                </div>

                <button id="menu-toggle" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors" aria-label="Toggle menu">
                    <i class="fas fa-bars text-lg" id="menu-icon"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ url('/') }}" class="flex items-center gap-2 px-3 py-2.5 text-sm font-medium {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all">
                    <i class="fas fa-home w-4"></i>Home
                </a>
                <a href="{{ url('/produk') }}" class="flex items-center gap-2 px-3 py-2.5 text-sm font-medium {{ request()->is('produk') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all">
                    <i class="fas fa-th-large w-4"></i>Produk
                </a>
                <a href="{{ url('/tentang') }}" class="flex items-center gap-2 px-3 py-2.5 text-sm font-medium {{ request()->is('tentang') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} rounded-lg transition-all">
                    <i class="fas fa-info-circle w-4"></i>Tentang Kami
                </a>
                <a href="#kontak" class="flex items-center gap-2 px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                    <i class="fas fa-envelope w-4"></i>Kontak
                </a>
                <div class="pt-2 border-t border-gray-100 flex gap-2">
                    <a href="{{ url('/masuk') }}" class="flex-1 text-center px-4 py-2.5 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300" id="kontak">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">

                {{-- Brand col --}}
                <div class="md:col-span-4">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-sign text-white text-sm"></i>
                        </div>
                        <div>
                            <span class="font-bold text-white text-base block leading-tight">AP Kreasi</span>
                            <span class="text-xs text-gray-500">Reklame & Neon Box</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-5">
                        Spesialis pembuatan reklame, neon box, dan signage custom berkualitas tinggi. Melayani seluruh Indonesia dengan pengiriman terpercaya.
                    </p>
                    <div class="flex gap-2">
                        <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook text-sm"></i>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-9 h-9 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>

                {{-- Layanan col --}}
                <div class="md:col-span-3">
                    <h4 class="font-semibold text-white text-sm uppercase tracking-wider mb-5">Layanan</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Reklame Custom</a></li>
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Neon Box</a></li>
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Letter Timbul</a></li>
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Baliho & Spanduk</a></li>
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Signage Kantor</a></li>
                    </ul>
                </div>

                {{-- Navigasi col --}}
                <div class="md:col-span-2">
                    <h4 class="font-semibold text-white text-sm uppercase tracking-wider mb-5">Navigasi</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Home</a></li>
                        <li><a href="{{ url('/produk') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Produk</a></li>
                        <li><a href="{{ url('/tentang') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Tentang Kami</a></li>
                        <li><a href="{{ url('/kalkulator') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Kalkulator</a></li>
                        <li><a href="{{ url('/dashboard') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-600"></i>Dashboard</a></li>
                    </ul>
                </div>

                {{-- Kontak col --}}
                <div class="md:col-span-3">
                    <h4 class="font-semibold text-white text-sm uppercase tracking-wider mb-5">Kontak</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-0.5 w-4 flex-shrink-0"></i>
                            <span class="text-gray-400 leading-relaxed">Jl. Raya Industri No. 12, Surabaya, Jawa Timur</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-blue-400 w-4 flex-shrink-0"></i>
                            <a href="tel:+6281234567890" class="text-gray-400 hover:text-blue-400 transition-colors">+62 812-3456-7890</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-blue-400 w-4 flex-shrink-0"></i>
                            <a href="mailto:info@apkreasi.com" class="text-gray-400 hover:text-blue-400 transition-colors">info@apkreasi.com</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-clock text-blue-400 w-4 flex-shrink-0"></i>
                            <span class="text-gray-400">Senin–Sabtu, 08.00–17.00</span>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Bottom bar --}}
            <div class="border-t border-gray-800 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-500">© 2025 AP Kreasi. All rights reserved.</p>
                <div class="flex gap-5 text-xs text-gray-500">
                    <a href="#" class="hover:text-gray-300 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-gray-300 transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Floating WhatsApp --}}
    <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20ingin%20konsultasi%20order%20reklame"
       target="_blank"
       class="whatsapp-float w-14 h-14 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center shadow-lg shadow-green-200 transition-colors"
       aria-label="Chat WhatsApp">
        <i class="fab fa-whatsapp text-white text-2xl"></i>
    </a>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('navbar-scrolled', window.scrollY > 20);
        });

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon   = document.getElementById('menu-icon');
        menuToggle.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            menuIcon.className = isHidden ? 'fas fa-times text-lg' : 'fas fa-bars text-lg';
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
