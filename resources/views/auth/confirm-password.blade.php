<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Password - PARI ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Anti Select Text */
        body { 
            font-family: 'Outfit', sans-serif; 
            -webkit-user-select: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
        }
        .blob { position: absolute; filter: blur(60px); opacity: 0.6; z-index: 0; }
        .anim-blob { animation: float 10s infinite ease-in-out; }
        @keyframes float { 
            0%, 100% { transform: translate(0, 0); } 
            50% { transform: translate(20px, -20px); } 
        }
        .animation-delay-2000 { animation-delay: 2s; }
    </style>
</head>
<body class="bg-zinc-50 min-h-screen w-full flex items-center justify-center p-4 relative overflow-x-hidden" oncontextmenu="return false;">

    <div class="fixed inset-0 pointer-events-none">
        <div class="blob anim-blob bg-green-200 w-72 h-72 rounded-full top-0 right-0 mix-blend-multiply"></div>
        <div class="blob anim-blob bg-blue-200 w-72 h-72 rounded-full bottom-0 left-0 mix-blend-multiply animation-delay-2000"></div>
    </div>

    <div class="w-full max-w-md bg-white/80 backdrop-blur-xl p-8 rounded-[2rem] shadow-2xl border border-white/60 relative z-10 my-4">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white shadow-lg border-4 border-white/50 text-zinc-900 mb-6 overflow-hidden relative">
                <div class="w-12 h-12 bg-zinc-900 rounded-full flex items-center justify-center text-white text-lg font-bold">
                    🔒
                </div>
            </div>
            <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">Konfirmasi Keamanan</h1>
            <p class="text-zinc-500 text-sm mt-2 font-medium">
                Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password -->
            <div>
                <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1.5 ml-1">Password</label>
                <div class="relative group">
                    <span class="absolute left-4 top-3.5 text-zinc-400 group-focus-within:text-green-600 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required autocomplete="current-password" 
                           placeholder="Masukkan password Anda"
                           class="w-full pl-12 pr-10 py-3.5 bg-zinc-50/50 border border-zinc-200 rounded-xl text-sm font-bold text-zinc-900 focus:ring-2 focus:ring-green-500 focus:border-transparent focus:bg-white outline-none transition-all">
                    <button type="button" onclick="togglePass('password', this)" class="absolute right-3 top-3.5 text-zinc-400 hover:text-zinc-600 focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <small class="text-red-500 text-xs mt-2 ml-1 block">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-zinc-900 text-white px-8 py-3.5 rounded-xl text-sm font-bold hover:bg-zinc-800 active:scale-[0.98] transition shadow-lg shadow-zinc-900/20 flex items-center justify-center gap-2">
                    Konfirmasi
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                btn.innerHTML = '<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>';
            } else {
                input.type = "password";
                btn.innerHTML = '<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
            }
        }

        // Prevent F12, Ctrl+Shift+I, Ctrl+Shift+C, Ctrl+Shift+J, Ctrl+U
        document.onkeydown = function(e) {
            if(event.keyCode == 123) { return false; }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) { return false; }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) { return false; }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) { return false; }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { return false; }
        }
    </script>
</body>
</html>