<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Blac Joyaux</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface":              "#faf7f2",
                        "surface-container":    "#efeded",
                        "surface-container-low":"#f5f3f3",
                        "on-surface":           "#1b1c1c",
                        "on-surface-variant":   "#444748",
                        "outline-variant":      "#c4c7c7",
                        "primary":              "#000000",
                        "secondary":            "#a07830",
                        "on-secondary":         "#ffffff",
                        "secondary-container":  "#f5e6c8",
                        "on-secondary-container":"#6b4f10",
                        "error":                "#ba1a1a",
                        "error-container":      "#ffdad6",
                        "on-error-container":   "#93000a",
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Manrope', sans-serif; background: #efeded; color: #1b1c1c; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 1rem; border-radius: 4px; font-size: 0.875rem; font-weight: 500; color: #444748; transition: background 0.15s, color 0.15s; }
        .sidebar-link:hover, .sidebar-link.active { background: #f5e6c8; color: #a07830; }
        .sidebar-link.active { font-weight: 600; }
        #mobile-sidebar { transition: transform 0.3s ease; }
        #mobile-sidebar.closed { transform: translateX(-100%); }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex">

    {{-- ====================== SIDEBAR (desktop) ====================== --}}
    <aside class="hidden lg:flex flex-col w-64 bg-surface border-r border-outline-variant/30 min-h-screen sticky top-0 h-screen overflow-y-auto flex-shrink-0">
        <div class="p-6 border-b border-outline-variant/30">
            <div class="flex flex-col">
                <span class="font-serif text-3xl text-secondary leading-none" style="font-family:'Libre Caslon Text',serif">Bj</span>
                <span class="text-xs tracking-[0.2em] uppercase text-primary mt-1 font-semibold">Blac Joyaux</span>
                <span class="text-[10px] tracking-widest text-on-surface-variant uppercase mt-0.5">Administration</span>
            </div>
        </div>
        <nav class="flex flex-col gap-1 p-4 flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> Vue d'ensemble
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span> Commandes
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span> Catalogue
            </a>
            <a href="{{ route('admin.inventory.index') }}" class="sidebar-link {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">storefront</span> Inventaire
            </a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">group</span> Clients
            </a>
            <div class="h-px bg-outline-variant/30 my-3"></div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">open_in_new</span> Voir le site
            </a>
        </nav>
        <div class="p-4 border-t border-outline-variant/30">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left hover:text-error">
                    <span class="material-symbols-outlined text-[20px]">logout</span> Déconnexion
                </button>
            </form>
        </div>
    </aside>

    {{-- ====================== MOBILE SIDEBAR OVERLAY ====================== --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-40 lg:hidden hidden"></div>
    <aside id="mobile-sidebar" class="closed fixed inset-y-0 left-0 w-64 bg-surface z-50 lg:hidden flex flex-col border-r border-outline-variant/30 overflow-y-auto">
        <div class="p-6 border-b border-outline-variant/30 flex items-center justify-between">
            <span class="font-semibold text-primary text-sm uppercase tracking-widest">Menu</span>
            <button id="sidebar-close" class="text-on-surface-variant">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex flex-col gap-1 p-4 flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> Vue d'ensemble
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span> Commandes
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span> Catalogue
            </a>
            <a href="{{ route('admin.inventory.index') }}" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">storefront</span> Inventaire
            </a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link">
                <span class="material-symbols-outlined text-[20px]">group</span> Clients
            </a>
        </nav>
    </aside>

    {{-- ====================== MAIN AREA ====================== --}}
    <div class="flex flex-col flex-grow min-w-0">
        {{-- Top bar --}}
        <header class="bg-surface border-b border-outline-variant/30 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button id="sidebar-open" class="lg:hidden text-on-surface-variant hover:text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="text-sm font-semibold text-primary uppercase tracking-widest">@yield('page_title', 'Administration')</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-on-surface-variant hidden sm:block">{{ auth('admin')->user()?->name ?? 'Admin' }}</span>
                <div class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-on-secondary text-xs font-bold">
                    {{ substr(auth('admin')->user()?->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
        <div class="mx-6 mt-4 bg-secondary-container text-on-secondary-container border border-secondary/30 px-4 py-3 text-sm flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()"><span class="material-symbols-outlined text-[18px]">close</span></button>
        </div>
        @endif
        @if(session('error'))
        <div class="mx-6 mt-4 bg-error-container text-on-error-container border border-error/30 px-4 py-3 text-sm flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()"><span class="material-symbols-outlined text-[18px]">close</span></button>
        </div>
        @endif

        <main class="flex-grow p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    <script>
        const open  = document.getElementById('sidebar-open');
        const close = document.getElementById('sidebar-close');
        const side  = document.getElementById('mobile-sidebar');
        const over  = document.getElementById('sidebar-overlay');
        open?.addEventListener('click', () => { side.classList.remove('closed'); over.classList.remove('hidden'); });
        function closeSidebar() { side.classList.add('closed'); over.classList.add('hidden'); }
        close?.addEventListener('click', closeSidebar);
        over?.addEventListener('click', closeSidebar);
    </script>
    @stack('scripts')
</body>
</html>
