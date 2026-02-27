<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mandiri Acu System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='12' cy='12' r='10' fill='%232563eb'/%3E%3Cpath d='M12 2a10 10 0 0 0 0 20 5 5 0 0 0 0-10 5 5 0 0 1 0-10z' fill='white'/%3E%3Ccircle cx='12' cy='7' r='1.5' fill='%232563eb'/%3E%3Ccircle cx='12' cy='17' r='1.5' fill='white'/%3E%3C/svg%3E">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .animated-bg {
            background: linear-gradient(-45deg, #f1f5f9, #e0f2fe, #f0f9ff, #ffffff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(50px) saturate(200%);
            -webkit-backdrop-filter: blur(50px) saturate(200%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1), 0 0 50px -10px rgba(6, 182, 212, 0.3);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.8);
            border-color: #06b6d4;
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.2);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }

        @keyframes blob-bounce {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.2); }
            66% { transform: translate(-20px, 20px) scale(0.8); }
        }
        .animate-blob { animation: blob-bounce 10s infinite alternate cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="animated-bg min-h-screen flex items-center justify-center relative overflow-hidden px-4">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-10 w-96 h-96 bg-cyan-400/40 rounded-full blur-[90px] animate-blob mix-blend-multiply"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-blue-500/40 rounded-full blur-[90px] animate-blob" style="animation-delay: 2s"></div>
    </div>

    <div class="relative z-10 w-full max-w-[420px]">
        <div class="glass-card rounded-[2.5rem] p-8 sm:p-10 relative overflow-hidden text-center">

            <div class="mb-8 relative z-10">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-blue-600 to-cyan-500 shadow-xl shadow-blue-500/40 mb-6 animate-float ring-4 ring-white/30 text-white">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tighter">
                    MANDIRI<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">AKUPUNTUR</span>
                </h2>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-2">LKP Akupunktur Mandiri System</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10 text-left">
                @csrf

                @if($errors->any())
                    <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3 text-red-600 text-[10px] font-bold backdrop-blur-md">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Email atau Password salah.
                    </div>
                @endif

                <div>
                    <label class="block mb-2 text-[10px] font-extrabold uppercase text-slate-500 tracking-widest ml-2">Email Klinik</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required class="glass-input w-full pl-12 pr-4 py-3.5 rounded-2xl text-sm text-slate-800 font-bold placeholder-slate-400 outline-none" placeholder="admin@lkpmandiri.com">
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-[10px] font-extrabold uppercase text-slate-500 tracking-widest ml-2">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required class="glass-input w-full pl-12 pr-4 py-3.5 rounded-2xl text-sm text-slate-800 font-bold outline-none" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full group relative flex justify-center items-center gap-2 py-4 px-4 text-sm font-black rounded-2xl text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:shadow-xl shadow-blue-500/30 transition-all transform hover:-translate-y-1 active:scale-95 mt-6 tracking-wide uppercase">
                    Masuk ke Sistem
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </form>

            <div class="mt-8 text-center pt-6 border-t border-slate-300/30">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">© {{ date('Y') }} PT Amarin Ship Management x LKP Mandiri</p>
            </div>
        </div>
    </div>

</body>
</html>
