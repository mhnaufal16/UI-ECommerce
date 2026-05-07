@extends('layouts.app')

@section('title', 'Daftar - AP Kreasi')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        
        {{-- Logo & Header --}}
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-xl shadow-blue-500/30 mb-4">
                <i class="fas fa-sign text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white mb-2">Buat Akun Baru</h2>
            <p class="text-gray-400 text-sm">Daftar untuk mulai order reklame custom</p>
        </div>

        {{-- Register Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 animate-slide-up">
            
            {{-- Social Register --}}
            <div class="space-y-3 mb-6">
                <button type="button" onclick="registerWithGoogle()" 
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span class="font-semibold text-gray-700 group-hover:text-blue-600">Daftar dengan Google</span>
                </button>

                <button type="button" onclick="registerWithFacebook()"
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                    <i class="fab fa-facebook text-blue-600 text-xl"></i>
                    <span class="font-semibold text-gray-700 group-hover:text-blue-600">Daftar dengan Facebook</span>
                </button>
            </div>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-medium">Atau daftar dengan email</span>
                </div>
            </div>

            {{-- Register Form --}}
            <form id="register-form" onsubmit="handleRegister(event)">
                
                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-1"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                           placeholder="Nama lengkap Anda"
                           autocomplete="name">
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>Email
                    </label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                           placeholder="nama@email.com"
                           autocomplete="email">
                </div>

                {{-- WhatsApp --}}
                <div class="mb-4">
                    <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fab fa-whatsapp text-gray-400 mr-1"></i>Nomor WhatsApp
                    </label>
                    <div class="flex rounded-xl border-2 border-gray-200 overflow-hidden focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-100 transition-all">
                        <span class="px-4 py-3 bg-gray-50 text-gray-600 border-r-2 border-gray-200 font-medium">+62</span>
                        <input type="tel" id="whatsapp" name="whatsapp" required
                               class="flex-1 px-4 py-3 outline-none"
                               placeholder="81234567890"
                               autocomplete="tel">
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all pr-12"
                               placeholder="Minimal 8 karakter"
                               autocomplete="new-password">
                        <button type="button" onclick="togglePassword('password')" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1.5">Gunakan minimal 8 karakter dengan kombinasi huruf dan angka</p>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all pr-12"
                               placeholder="Ulangi password"
                               autocomplete="new-password">
                        <button type="button" onclick="togglePassword('password_confirmation')" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password_confirmation-icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="mb-6">
                    <label class="flex items-start gap-2 cursor-pointer group">
                        <input type="checkbox" name="terms" required
                               class="w-4 h-4 mt-0.5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Syarat & Ketentuan</a> 
                            dan <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Kebijakan Privasi</a>
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="register-btn"
                        class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-blue-200 mb-4">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </button>

                {{-- Login Link --}}
                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ url('/masuk') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </form>

        </div>

        {{-- Security Badge --}}
        <div class="mt-6 flex items-center justify-center gap-6 text-gray-400">
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-sm"></i>
                <span class="text-xs">Data Aman</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-lock text-sm"></i>
                <span class="text-xs">SSL Secure</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-user-shield text-sm"></i>
                <span class="text-xs">Privasi Terjaga</span>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const passwordIcon = document.getElementById(fieldId + '-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
    }
}

function handleRegister(event) {
    event.preventDefault();
    
    const btn = document.getElementById('register-btn');
    const form = document.getElementById('register-form');
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    
    // Validate password match
    if (password !== passwordConfirmation) {
        showError('Password dan konfirmasi password tidak cocok');
        return;
    }
    
    // Validate password length
    if (password.length < 8) {
        showError('Password minimal 8 karakter');
        return;
    }
    
    // Disable button
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendaftarkan...';
    
    // Simulate registration delay
    setTimeout(() => {
        // Success
        btn.innerHTML = '<i class="fas fa-check mr-2"></i>Berhasil Terdaftar!';
        btn.className = btn.className.replace('from-blue-600 to-blue-700', 'from-green-500 to-green-600');
        
        // Show success message
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-50 border border-green-200 rounded-xl p-4 mb-4 animate-slide-up';
        successDiv.innerHTML = `
            <div class="flex items-start gap-3">
                <i class="fas fa-check-circle text-green-500 text-xl mt-0.5"></i>
                <div>
                    <p class="text-sm font-semibold text-green-800">Pendaftaran Berhasil!</p>
                    <p class="text-xs text-green-700 mt-1">Akun Anda telah dibuat. Anda akan diarahkan ke dashboard...</p>
                </div>
            </div>
        `;
        form.insertBefore(successDiv, form.firstChild);
        
        // Redirect to dashboard
        setTimeout(() => {
            window.location.href = '{{ url("/dashboard") }}';
        }, 1500);
    }, 1500);
}

function showError(message) {
    const form = document.getElementById('register-form');
    
    // Remove existing error
    const existingError = form.querySelector('.bg-red-50');
    if (existingError) existingError.remove();
    
    // Show error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'bg-red-50 border border-red-200 rounded-xl p-3 mb-4 flex items-center gap-2 animate-slide-up';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle text-red-500"></i><span class="text-sm text-red-700">${message}</span>`;
    form.insertBefore(errorDiv, form.firstChild);
    
    // Remove error after 3 seconds
    setTimeout(() => errorDiv.remove(), 3000);
}

function registerWithGoogle() {
    alert('Fitur daftar dengan Google akan segera tersedia!');
}

function registerWithFacebook() {
    alert('Fitur daftar dengan Facebook akan segera tersedia!');
}
</script>
@endpush
