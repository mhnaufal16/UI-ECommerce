@extends('layouts.app')

@section('title', 'Lupa Password - AP Kreasi')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        
        {{-- Logo & Header --}}
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-xl shadow-blue-500/30 mb-4">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white mb-2">Lupa Password?</h2>
            <p class="text-gray-400 text-sm">Masukkan email Anda untuk reset password</p>
        </div>

        {{-- Forgot Password Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 animate-slide-up">
            
            {{-- Info --}}
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                <div>
                    <p class="text-sm font-semibold text-blue-800">Cara Reset Password</p>
                    <p class="text-xs text-blue-700 mt-1">Kami akan mengirimkan link reset password ke email Anda. Link berlaku selama 1 jam.</p>
                </div>
            </div>

            {{-- Form --}}
            <form id="forgot-form" onsubmit="handleForgotPassword(event)">
                
                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>Email Terdaftar
                    </label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                           placeholder="nama@email.com"
                           autocomplete="email">
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="submit-btn"
                        class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-blue-200 mb-4">
                    <i class="fas fa-paper-plane mr-2"></i>Kirim Link Reset
                </button>

                {{-- Back to Login --}}
                <a href="{{ url('/masuk') }}" class="block text-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke halaman masuk
                </a>
            </form>

        </div>

        {{-- Alternative Contact --}}
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-400 mb-3">Tidak bisa akses email?</p>
            <a href="https://wa.me/6281234567890?text=Halo%20AP%20Kreasi%2C%20saya%20butuh%20bantuan%20reset%20password"
               target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-green-200">
                <i class="fab fa-whatsapp"></i>
                Hubungi via WhatsApp
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
function handleForgotPassword(event) {
    event.preventDefault();
    
    const btn = document.getElementById('submit-btn');
    const form = document.getElementById('forgot-form');
    const email = document.getElementById('email').value;
    
    // Disable button
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
    
    // Simulate sending email
    setTimeout(() => {
        // Success
        btn.innerHTML = '<i class="fas fa-check mr-2"></i>Email Terkirim!';
        btn.className = btn.className.replace('from-blue-600 to-blue-700', 'from-green-500 to-green-600');
        
        // Show success message
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-50 border border-green-200 rounded-xl p-4 mb-4 animate-slide-up';
        successDiv.innerHTML = `
            <div class="flex items-start gap-3">
                <i class="fas fa-check-circle text-green-500 text-xl mt-0.5"></i>
                <div>
                    <p class="text-sm font-semibold text-green-800">Link Reset Terkirim!</p>
                    <p class="text-xs text-green-700 mt-1">Kami telah mengirim link reset password ke <strong>${email}</strong>. Silakan cek inbox atau folder spam Anda.</p>
                    <p class="text-xs text-green-600 mt-2">Link berlaku selama 1 jam.</p>
                </div>
            </div>
        `;
        form.insertBefore(successDiv, form.firstChild);
        
        // Disable form
        document.getElementById('email').disabled = true;
        
        // Add resend button
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-redo mr-2"></i>Kirim Ulang Link';
            btn.className = btn.className.replace('from-green-500 to-green-600', 'from-gray-500 to-gray-600');
            btn.disabled = false;
        }, 3000);
        
    }, 1500);
}
</script>
@endpush
