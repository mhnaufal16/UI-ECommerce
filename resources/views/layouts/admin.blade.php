<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — AP Kreasi Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe',
                            300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6',
                            600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a',
                        },
                    },
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }

        .sidebar { width: 260px; min-height: 100vh; background: #0f172a; transition: transform 0.3s ease; }
        .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; color: #94a3b8; transition: all 0.2s ease; margin-bottom: 2px; }
        .sidebar-link:hover { background: rgba(255,255,255,0.07); color: #e2e8f0; }
        .sidebar-link.active { background: rgba(37,99,235,0.2); color: #60a5fa; border-left: 3px solid #3b82f6; }
        .sidebar-link .icon { width: 18px; text-align: center; font-size: 15px; }
        .sidebar-group { font-size: 10px; font-weight: 700; letter-spacing: 0.1em; color: #475569; text-transform: uppercase; padding: 16px 16px 6px; }

        .skeleton { background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; border-radius: 6px; }
        @keyframes skeleton-loading { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }

        .data-table tbody tr { transition: background 0.15s ease; }
        .data-table tbody tr:hover { background: #f8fafc; }

        #sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 40; }
        #sidebar-overlay.active { display: block; }

        .notif-dot { width: 8px; height: 8px; background: #ef4444; border-radius: 50%; position: absolute; top: 6px; right: 6px; animation: pulse 2s infinite; }

        @media (max-width: 1024px) {
            .sidebar { position: fixed; top: 0; left: 0; z-index: 50; transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 h-full">

<div class="flex h-screen overflow-hidden">

    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <aside class="sidebar flex-shrink-0 flex flex-col" id="sidebar">
        <div class="flex items-center gap-3 px-5 py-5 border-b border-white/5">
            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-sign text-white text-sm"></i>
            </div>
            <div>
                <p class="font-bold text-white text-sm">AP Kreasi</p>
                <p class="text-xs text-slate-400">Admin Panel</p>
            </div>
            <button onclick="closeSidebar()" class="ml-auto lg:hidden text-slate-400 hover:text-white" aria-label="Tutup sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4">
            <p class="sidebar-group">Utama</p>
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie icon"></i> Dashboard
            </a>
            <a href="{{ url('/admin/orders') }}" class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list icon"></i> Manajemen Order
                <span class="ml-auto bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">12</span>
            </a>

            <p class="sidebar-group">Katalog</p>
            <a href="{{ url('/admin/products') }}" class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="fas fa-box icon"></i> Produk
            </a>
            <a href="{{ url('/admin/promos') }}" class="sidebar-link {{ request()->is('admin/promos*') ? 'active' : '' }}">
                <i class="fas fa-tag icon"></i> Diskon & Promo
            </a>

            <p class="sidebar-group">Konfigurasi</p>
            <a href="{{ url('/admin/pricing') }}" class="sidebar-link {{ request()->is('admin/pricing*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h icon"></i> Pengaturan Harga
            </a>
        </nav>

        <div class="px-3 py-4 border-t border-white/5">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 cursor-pointer transition-colors">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">AD</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">Admin Utama</p>
                    <p class="text-xs text-slate-400 truncate">admin@apkreasi.com</p>
                </div>
                <i class="fas fa-chevron-right text-slate-500 text-xs"></i>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">

        <header class="bg-white border-b border-gray-100 px-4 sm:px-6 h-16 flex items-center justify-between flex-shrink-0 shadow-sm">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="text-base font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-xs text-gray-400">@yield('page-subtitle', 'Selamat datang kembali')</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="hidden sm:flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-56">
                    <i class="fas fa-search text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Cari order, produk..." class="bg-transparent text-sm text-gray-600 outline-none w-full placeholder-gray-400" aria-label="Cari">
                </div>

                <div class="relative">
                    <button class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors" onclick="toggleNotif()" aria-label="Notifikasi">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="notif-dot"></span>
                    </button>
                    <div id="notif-dropdown" class="hidden absolute right-0 top-12 w-80 bg-white rounded-xl shadow-xl border border-gray-100 z-50">
                        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900 text-sm">Notifikasi</h3>
                            <span class="text-xs text-blue-600 font-medium cursor-pointer">Tandai semua dibaca</span>
                        </div>
                        <div class="divide-y divide-gray-50 max-h-72 overflow-y-auto">
                            @foreach([
                                ['name' => 'Budi Santoso', 'product' => 'Neon Box 2x1m', 'time' => '5 menit lalu', 'unread' => true],
                                ['name' => 'Siti Rahayu', 'product' => 'Reklame Akrilik 3x2m', 'time' => '1 jam lalu', 'unread' => true],
                                ['name' => 'Ahmad Fauzi', 'product' => 'Letter Timbul', 'time' => '3 jam lalu', 'unread' => false],
                            ] as $notif)
                            <div class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 cursor-pointer {{ $notif['unread'] ? 'bg-blue-50/50' : '' }}">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-shopping-cart text-blue-600 text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Order Baru</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $notif['name'] }} — {{ $notif['product'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $notif['time'] }}</p>
                                </div>
                                @if($notif['unread'])
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="px-4 py-3 border-t border-gray-100 text-center">
                            <a href="#" class="text-xs text-blue-600 font-medium hover:underline">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>

                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer">AD</div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebar-overlay').classList.toggle('active');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('active');
    }
    function toggleNotif() {
        document.getElementById('notif-dropdown').classList.toggle('hidden');
    }
    document.addEventListener('click', (e) => {
        const notifBtn = e.target.closest('[onclick="toggleNotif()"]');
        const notifDrop = document.getElementById('notif-dropdown');
        if (!notifBtn && !notifDrop.contains(e.target)) notifDrop.classList.add('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
