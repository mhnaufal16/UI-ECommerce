@extends('layouts.app')

@section('title', 'Masuk - AP Kreasi')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        
        {{-- Logo & Header --}}
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-xl shadow-blue-500/30 mb-4">
                <i class="fas fa-sign text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white mb-2">Selamat Datang Kembali</h2>
            <p class="text-gray-400 text-sm">Masuk ke akun AP Kreasi Anda</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 animate-slide-up">
            
            {{-- Social Login --}}
            <div class="space-y-3 mb-6">
                <button type="button" onclick="loginWithGoogle()" 
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span class="font-semibold text-gray-700 group-hover:text-blue-600">Masuk dengan Google</span>
                </button>

                <button type="button" onclick="loginWithFacebook()"
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                    <i class="fab fa-facebook text-blue-600 text-xl"></i>
                    <span class="font-semibold text-gray-700 group-hover:text-blue-600">Masuk dengan Facebook</span>
                </button>
            </div>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-medium">Atau masuk dengan email</span>
                </div>
            </div>

            {{-- Login Form --}}
            <form id="login-form" onsubmit="handleLogin(event)">
                
                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>Email atau WhatsApp
                    </label>
                    <input type="text" id="email" name="email" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                           placeholder="nama@email.com atau 081234567890"
                           autocomplete="email">
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all pr-12"
                               placeholder="Masukkan password"
                               autocomplete="current-password">
                        <button type="button" onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" 
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Ingat saya</span>
                    </label>
                    <a href="{{ url('/lupa-password') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        Lupa password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="login-btn"
                        class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-blue-200 mb-4">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>

                {{-- Demo Accounts Info --}}
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                    <p class="text-xs font-semibold text-amber-800 mb-2 flex items-center gap-2">
                        <i class="fas fa-info-circle"></i>Demo Akun (UI Only)
                    </p>
                    <div class="space-y-1 text-xs text-amber-700">
                        <p><strong>User:</strong> user@demo.com / pass: user123</p>
                        <p><strong>Admin:</strong> admin@demo.com / pass: admin123</p>
                    </div>
                </div>

                {{-- Register Link --}}
                <p class="text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ url('/daftar') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </form>

        </div>

        {{-- Security Badge --}}
        <div class="mt-6 flex items-center justify-center gap-6 text-gray-400">
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-sm"></i>
                <span class="text-xs">Aman & Terenkripsi</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-lock text-sm"></i>
                <span class="text-xs">SSL Secure</span>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
    }
}

function handleLogin(event) {
    event.preventDefault();
    
    const btn = document.getElementById('login-btn');
    const email = document.getElementById('email').value.toLowerCase();
    const password = document.getElementById('password').value;
    
    // Disable button
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
    
    // Simulate login delay
    setTimeout(() => {
        // Demo authentication (UI only)
        if ((email === 'user@demo.com' && password === 'user123') || 
            (email === '081234567890' && password === 'user123')) {
            // User login
            btn.innerHTML = '<i class="fas fa-check mr-2"></i>Berhasil!';
            btn.className = btn.className.replace('from-blue-600 to-blue-700', 'from-green-500 to-green-600');
            
            setTimeout(() => {
                window.location.href = '{{ url("/dashboard") }}';
            }, 500);
            
        } else if (email === 'admin@demo.com' && password === 'admin123') {
            // Admin login
            btn.innerHTML = '<i class="fas fa-check mr-2"></i>Berhasil!';
            btn.className = btn.className.replace('from-blue-600 to-blue-700', 'from-green-500 to-green-600');
            
            setTimeout(() => {
                window.location.href = '{{ url("/admin/dashboard") }}';
            }, 500);
            
        } else {
            // Failed login
            btn.innerHTML = '<i class="fas fa-times mr-2"></i>Email atau password salah';
            btn.className = btn.className.replace('from-blue-600 to-blue-700', 'from-red-500 to-red-600');
            
            // Show error message
            const form = document.getElementById('login-form');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-50 border border-red-200 rounded-xl p-3 mb-4 flex items-center gap-2 animate-slide-up';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle text-red-500"></i><span class="text-sm text-red-700">Email atau password yang Anda masukkan salah.</span>';
            form.insertBefore(errorDiv, form.firstChild);
            
            // Reset button after 2 seconds
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i>Masuk';
                btn.className = btn.className.replace('from-red-500 to-red-600', 'from-blue-600 to-blue-700');
                errorDiv.remove();
            }, 2000);
        }
    }, 1000);
}

function loginWithGoogle() {
    alert('Fitur login dengan Google akan segera tersedia!\n\nUntuk demo, gunakan:\nuser@demo.com / user123');
}

function loginWithFacebook() {
    alert('Fitur login dengan Facebook akan segera tersedia!\n\nUntuk demo, gunakan:\nuser@demo.com / user123');
}

// Auto-fill demo account on click
document.addEventListener('DOMContentLoaded', function() {
    const demoInfo = document.querySelector('.bg-amber-50');
    if (demoInfo) {
        demoInfo.style.cursor = 'pointer';
        demoInfo.addEventListener('click', function() {
            document.getElementById('email').value = 'user@demo.com';
            document.getElementById('password').value = 'user123';
        });
    }
});
</script>
@endpush
