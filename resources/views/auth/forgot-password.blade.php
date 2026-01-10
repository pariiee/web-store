<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - PARI ID</title>
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
                    🔑
                </div>
            </div>
            <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">Reset Password</h1>
            <p class="text-zinc-500 text-sm mt-2 font-medium">
                Lupa password? Tidak masalah. Beri tahu kami email Anda dan kami akan mengirimkan link reset password.
            </p>
        </div>

        <!-- Session Status -->
        @if(session('status'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-xl text-sm font-medium">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1.5 ml-1">Email</label>
                <div class="relative group">
                    <span class="absolute left-4 top-3.5 text-zinc-400 group-focus-within:text-green-600 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required autofocus 
                           placeholder="email@example.com" value="{{ old('email') }}"
                           class="w-full pl-12 pr-4 py-3.5 bg-zinc-50/50 border border-zinc-200 rounded-xl text-sm font-bold text-zinc-900 focus:ring-2 focus:ring-green-500 focus:border-transparent focus:bg-white outline-none transition-all">
                </div>
                @error('email')
                    <small class="text-red-500 text-xs mt-2 ml-1 block">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-xs text-zinc-500 font-medium hover:text-zinc-700 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Login
                </a>
                <button type="submit" class="bg-zinc-900 text-white px-8 py-3.5 rounded-xl text-sm font-bold hover:bg-zinc-800 active:scale-[0.98] transition shadow-lg shadow-zinc-900/20 flex items-center justify-center gap-2">
                    Kirim Link Reset
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
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