<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akupunktur - LKP Mandiri</title>

    {{-- ICON YIN YANG MODERN --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='12' cy='12' r='10' fill='%232563eb'/%3E%3Cpath d='M12 2a10 10 0 0 0 0 20 5 5 0 0 0 0-10 5 5 0 0 1 0-10z' fill='white'/%3E%3Ccircle cx='12' cy='7' r='1.5' fill='%232563eb'/%3E%3Ccircle cx='12' cy='17' r='1.5' fill='white'/%3E%3C/svg%3E">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: #f0f9ff;
            color: #334155;
            overflow-x: hidden;
        }

        /* Ambient Glow & Glassmorphism */
        .ambient-glow {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -1;
            background:
                radial-gradient(circle at 10% 20%, rgba(56, 189, 248, 0.15), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.15), transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.8), transparent 100%);
            pointer-events: none;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .sidebar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 4px 0 30px rgba(56, 189, 248, 0.05);
        }

        .nav-item-active {
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
            color: white !important;
            box-shadow: 0 8px 20px -4px rgba(14, 165, 233, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="antialiased selection:bg-cyan-100 selection:text-cyan-700">

    <div class="ambient-glow"></div>

    {{-- NAVBAR --}}
    <nav class="fixed top-0 z-50 w-full glass-panel transition-all duration-300">
      <div class="px-4 py-3 lg:px-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start gap-3">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-slate-500 rounded-lg sm:hidden hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <span class="sr-only">Buka sidebar</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path></svg>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
              <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-lg shadow-cyan-500/30 transition-transform group-hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
              </div>
              <div class="flex flex-col">
                  <span class="text-xl font-black tracking-tight text-slate-800">
                    MANDIRI<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">ACU</span>
                  </span>
                  <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest -mt-0.5">Sistem Klinik v1.0</span>
              </div>
            </a>
          </div>

          {{-- PROFILE DROPDOWN --}}
          @auth
          <div class="flex items-center">
              <div class="flex items-center ml-3">
                <button type="button" class="flex text-sm bg-white rounded-full focus:ring-4 focus:ring-blue-100 transition-all shadow-sm border border-slate-200 p-0.5" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <img class="w-9 h-9 rounded-full shadow-md shadow-blue-500/10" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0ea5e9&color=fff" alt="user photo">
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-slate-50 rounded-2xl shadow-xl border border-slate-100 w-60 overflow-hidden" id="dropdown-user">
                  <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-blue-50/30">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-medium text-slate-500 truncate">{{ Auth::user()->email }}</p>
                  </div>
                  <ul class="py-2">
                    {{-- Menu Edit Profil --}}
                    <li>
                      <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Edit Profil
                      </a>
                    </li>

                    {{-- Menu Logout --}}
                    <li class="border-t border-slate-100 mt-1 pt-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 px-5 py-2.5 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition-colors font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          @endauth
        </div>
      </div>
    </nav>

    {{-- SIDEBAR --}}
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen pt-24 transition-transform -translate-x-full sidebar-glass sm:translate-x-0">
       <div class="h-full px-4 pb-4 overflow-y-auto custom-scrollbar">

          {{-- MENU UTAMA --}}
          <div class="mb-3 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Utama</div>
          <ul class="space-y-2 font-medium mb-8">
             <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'nav-item-active' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                   <span class="ml-3 font-semibold">Dashboard</span>
                </a>
             </li>
          </ul>

          {{-- MENU KLINIK & MEDIS --}}
          <div class="mb-3 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Klinik & Medis</div>
          <ul class="space-y-2 font-medium mb-8">
             <li>
                <a href="{{ route('patients.index') }}" class="flex items-center p-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('patients.*') || request()->routeIs('medical-records.*') ? 'nav-item-active' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('patients.*') || request()->routeIs('medical-records.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="ml-3 font-semibold">Manajemen Pasien</span>
                </a>
             </li>
          </ul>

          {{-- MENU PENGATURAN PROFIL (UNTUK SEMUA USER) --}}
          @auth
          <div class="mb-3 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-6">Akun & Preferensi</div>
          <ul class="space-y-2 font-medium mb-8">
             <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('profile.*') ? 'nav-item-active' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                   <span class="ml-3 font-semibold">Pengaturan Profil</span>
                </a>
             </li>
          </ul>
          @endauth

          {{-- MENU KHUSUS SUPER ADMIN --}}
          @if(Auth::check() && Auth::user()->role === 'super_admin')
          <div class="mb-3 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-6">Sistem Administrator</div>
          <ul class="space-y-2 font-medium">
             <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.users.*') ? 'nav-item-active' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                   <span class="ml-3 font-semibold">User Management</span>
                </a>
             </li>
          </ul>
          @endif
       </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="p-4 sm:p-6 sm:ml-72 mt-20">
        {{-- Slot untuk Component Breeze --}}
        {{ $slot ?? '' }}

        {{-- Yield untuk Extend klasik --}}
        @yield('content')
    </div>

    {{-- GLOBAL SWEET ALERT HANDLER --}}
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
                confirmButtonColor: '#3b82f6',
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#ef4444',
            });
        @endif

        // Global Delete Confirmation
        window.confirmDelete = function(event, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        };
    </script>
</body>
</html>
