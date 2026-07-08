<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blac Joyaux') — Luxe, Élégance, Intemporalité</title>
    <meta name="description" content="@yield('meta_description', 'Blac Joyaux — Maison de maroquinerie de luxe artisanale. Des sacs d\'exception, nés à Abidjan.')">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* Heritage Excellence Design System */
                        "surface":                "#FFFFFF",
                        "surface-dim":            "#dbdad9",
                        "surface-bright":         "#f2ede0",
                        "surface-container-lowest":"#ffffff",
                        "surface-container-low":  "#f5f3f3",
                        "surface-container":      "#efeded",
                        "surface-container-high": "#e9e8e7",
                        "surface-container-highest":"#e4e2e2",
                        "on-surface":             "#1b1c1c",
                        "on-surface-variant":     "#2a2b2c",
                        "inverse-surface":        "#303031",
                        "inverse-on-surface":     "#f2f0f0",
                        "outline":                "#747878",
                        "outline-variant":        "#c4c7c7",
                        "primary":                "#000000",
                        "on-primary":             "#ffffff",
                        "primary-container":      "#1c1b1b",
                        "on-primary-container":   "#858383",
                        "inverse-primary":        "#c8c6c5",
                        /* Artisan Gold — accent signature */
                        "secondary":              "#8c621a",
                        "on-secondary":           "#ffffff",
                        "secondary-container":    "#f5e6c8",
                        "on-secondary-container": "#6b4f10",
                        "secondary-fixed":        "#f0d898",
                        "secondary-fixed-dim":    "#d4b060",
                        "background":             "#FFFFFF",
                        "on-background":          "#1b1c1c",
                        "error":                  "#ba1a1a",
                        "on-error":               "#ffffff",
                        "error-container":        "#ffdad6",
                    },
                    fontFamily: {
                        "serif":    ["Libre Caslon Text", "Georgia", "serif"],
                        "sans":     ["Manrope", "system-ui", "sans-serif"],
                    },
                    fontSize: {
                        "display":   ["clamp(2.5rem,6vw,4rem)",   { lineHeight: "1.1",  letterSpacing: "-0.02em", fontWeight: "400" }],
                        "h1":        ["clamp(2rem,4vw,2.5rem)",   { lineHeight: "1.2",  fontWeight: "400" }],
                        "h2":        ["clamp(1.5rem,3vw,2rem)",   { lineHeight: "1.25", fontWeight: "400" }],
                        "h3":        ["clamp(1.2rem,2.5vw,1.5rem)",{ lineHeight: "1.3", fontWeight: "400" }],
                        "body-lg":   ["1.125rem",                 { lineHeight: "1.75", fontWeight: "400" }],
                        "body":      ["1rem",                     { lineHeight: "1.6",  fontWeight: "400" }],
                        "label":     ["0.875rem",                 { lineHeight: "1.25", letterSpacing: "0.1em", fontWeight: "600" }],
                        "caption":   ["0.8rem",                  { lineHeight: "1.2",  letterSpacing: "0.05em", fontWeight: "600" }],
                    },
                    spacing: {
                        "px-mobile":  "1.25rem",  /* 20px */
                        "px-desktop": "5rem",     /* 80px */
                        "section":    "7.5rem",   /* 120px */
                        "gutter":     "2rem",     /* 32px */
                    },
                    maxWidth: {
                        "site": "1440px",
                    },
                    boxShadow: {
                        "luxury": "0 12px 40px rgba(0,0,0,0.12)",
                        "card":   "0 4px 20px rgba(0,0,0,0.08)",
                    },
                }
            }
        }
    </script>

    <style>
        /* ---- Global base ---- */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            background-color: #FFFFFF;
            color: #1b1c1c;
            font-family: 'Manrope', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Material Symbols */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Ivorian pattern background (subtil) */
        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23a07830' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Gold underline animation */
        .nav-link {
            position: relative;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: #8c621a;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* Input focus gold */
        .input-gold:focus {
            outline: none;
            border-color: #8c621a;
            box-shadow: 0 1px 0 0 #8c621a;
        }

        /* Mobile drawer */
        #mobile-menu {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        }
        #mobile-menu.hidden-menu {
            transform: translateX(-100%);
            opacity: 0;
            pointer-events: none;
        }
        #mobile-menu.open-menu {
            transform: translateX(0);
            opacity: 1;
        }

        /* Scroll header shrink */
        #main-header.scrolled {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
        }

        /* Gold chip */
        .chip-gold {
            display: inline-block;
            background: #8c621a;
            color: #fff;
            font-family: 'Manrope', sans-serif;
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 2px 8px;
        }

        /* Product card hover */
        .product-card .card-img { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .product-card:hover .card-img { transform: scale(1.04); }

        /* Button styles */
        .btn-primary {
            display: inline-block;
            background: #000;
            color: #fff;
            font-family: 'Manrope', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.875rem 2rem;
            transition: background 0.2s, color 0.2s;
        }
        .btn-primary:hover { background: #8c621a; }

        .btn-outline {
            display: inline-block;
            background: transparent;
            color: #000;
            font-family: 'Manrope', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.875rem 2rem;
            border: 1px solid #8c621a;
            transition: background 0.2s, color 0.2s;
        }
        .btn-outline:hover { background: #8c621a; color: #fff; }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col antialiased">

    {{-- ====================== HEADER / NAV ====================== --}}>

    {{-- ====================== HEADER / NAV ====================== --}}
    <header id="main-header" class="bg-surface/80 backdrop-blur-md fixed top-0 left-0 w-full z-50 border-b border-outline-variant/20 transition-all duration-300 py-4">
        <div class="grid grid-cols-3 items-center max-w-site mx-auto px-px-mobile md:px-px-desktop">

            {{-- Left Side --}}
            <div class="flex items-center justify-start gap-8">
                <button id="menu-open-btn" class="md:hidden text-primary p-1" aria-label="Ouvrir le menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('collections.index') }}" class="nav-link text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">Collections</a>
                    <a href="{{ route('innovation') }}" class="nav-link text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">Innovation</a>
                    <a href="{{ route('about') }}" class="nav-link text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">À Propos</a>
                </nav>
            </div>

            {{-- Center Logo --}}
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="flex items-center justify-center group" aria-label="Blac Joyaux — Accueil">
                    <img src="{{ asset('img/logo.png') }}" alt="Blac Joyaux Logo" class="h-12 md:h-16 w-auto object-contain group-hover:opacity-80 transition-opacity">
                </a>
            </div>

            {{-- Right Side --}}
            <div class="flex items-center justify-end gap-4 md:gap-6 text-primary">
                {{-- Search Bar --}}
                <div id="search-container" class="absolute right-0 top-0 translate-x-full opacity-0 transition-all duration-300 pointer-events-none flex items-center gap-2 bg-surface border border-outline-variant/30 px-3 py-1 rounded-full shadow-luxury">
                    <form action="{{ route('boutique.index') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="search" placeholder="Rechercher un sac..."
                               class="bg-transparent border-none text-sm font-sans text-on-surface focus:ring-0 w-48 md:w-64">
                        <button type="submit" class="text-primary hover:text-secondary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </button>
                    </form>
                </div>

                {{-- Desktop right links --}}
                <nav class="hidden md:flex items-center gap-8 mr-4">
                    <a href="{{ route('boutique.index') }}" class="nav-link text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">Boutique</a>
                    <a href="{{ route('contact') }}" class="nav-link text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">Contact</a>
                </nav>

                <button id="search-toggle-btn" class="hover:text-secondary transition-colors" aria-label="Rechercher">
                    <span class="material-symbols-outlined text-[22px]">search</span>
                </button>


                <a href="{{ route('cart.index') }}" class="relative hover:text-secondary transition-colors" aria-label="Panier">
                    <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                    @if(session('cart_count', 0) > 0)
                    <span class="absolute -top-1 -right-2 text-[10px] bg-secondary text-on-secondary w-4 h-4 flex items-center justify-center rounded-full font-sans font-bold">
                        {{ session('cart_count', 0) }}
                    </span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('profile.index') }}" class="hidden md:block hover:text-secondary transition-colors" aria-label="Mon profil">
                        <span class="material-symbols-outlined text-[22px]">person</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden md:block text-label uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors">Connexion</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- ====================== MOBILE SIDE DRAWER ====================== --}}
    <div id="menu-overlay" class="fixed inset-0 bg-black/40 z-[60] hidden" aria-hidden="true"></div>
    <aside id="mobile-menu" class="hidden-menu fixed inset-y-0 left-0 w-[80vw] max-w-xs bg-surface z-[70] flex flex-col shadow-luxury overflow-y-auto" role="dialog" aria-modal="true" aria-label="Menu principal">
        <div class="flex items-center justify-between px-6 py-5 border-b border-outline-variant/30">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Blac Joyaux Logo" class="h-10 w-auto object-contain">
            </a>
            <button id="menu-close-btn" class="text-primary" aria-label="Fermer le menu">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex flex-col gap-1 p-6">
            <a href="{{ route('home') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">Accueil</a>
            <a href="{{ route('collections.index') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">Collections</a>
            <a href="{{ route('innovation') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">Innovation</a>
            <a href="{{ route('boutique.index') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">Boutique</a>
            <a href="{{ route('about') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">À Propos</a>
            <a href="{{ route('contact') }}" class="py-3 border-b border-outline-variant/20 text-label uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">Contact</a>
        </nav>
        <div class="p-6 mt-auto border-t border-outline-variant/30">
            @auth
                <a href="{{ route('profile.index') }}" class="btn-primary block text-center mb-3">Mon Compte</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-outline w-full">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-primary block text-center mb-3">Connexion</a>
                <a href="{{ route('register') }}" class="btn-outline block text-center">Créer un compte</a>
            @endauth
        </div>
    </aside>

    {{-- Header spacer removed to eliminate gap between header and first block --}}

    {{-- ====================== FLASH MESSAGES ====================== --}}
    @if(session('success'))
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop pt-4">
        <div class="bg-secondary-container text-on-secondary-container border border-secondary/30 px-4 py-3 text-body flex items-center justify-between gap-4">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop pt-4">
        <div class="bg-error-container text-on-error-container border border-error/30 px-4 py-3 text-body flex items-center justify-between gap-4">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    </div>
    @endif

    {{-- ====================== MAIN CONTENT ====================== --}}
    <main class="flex-grow pt-10">
        @yield('content')
    </main>

    {{-- ====================== FOOTER ====================== --}}
    <footer class="bg-surface py-16 border-t border-outline-variant/30">
        <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
            {{-- Brand --}}
            <div class="col-span-2 md:col-span-1 flex flex-col gap-4">
                <a href="{{ route('home') }}" class="flex flex-col">
                    <img src="{{ asset('img/logo.png') }}" alt="Blac Joyaux Logo" class="h-16 w-auto object-contain mb-2">
                </a>
                <p class="text-body text-on-surface-variant text-sm leading-relaxed">
                    Luxe. Élégance. Intemporalité.
                </p>
            </div>

            {{-- Collections --}}
            <div class="flex flex-col gap-4">
                <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">Collections</h4>
                <ul class="flex flex-col gap-2.5">
                    <li><a href="{{ route('boutique.index') }}?categorie=sacs-a-main" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Sacs à main</a></li>
                    <li><a href="{{ route('boutique.index') }}?categorie=elegance" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Sacs Élégance</a></li>
                    <li><a href="{{ route('boutique.index') }}?categorie=luxe" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Sacs Luxe</a></li>
                    <li><a href="{{ route('boutique.index') }}?nouveautes=1" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Nouveautés</a></li>
                </ul>
            </div>

            {{-- Informations --}}
            <div class="flex flex-col gap-4">
                <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">Informations</h4>
                <ul class="flex flex-col gap-2.5">
                    <li><a href="{{ route('about') }}" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">À Propos</a></li>
                    <li><a href="{{ route('contact') }}" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Contact</a></li>
                    <li><a href="#" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Livraison & retours</a></li>
                    <li><a href="#" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">Conditions générales</a></li>
                    <li><a href="#" class="text-body text-sm text-on-surface-variant hover:text-secondary transition-colors">FAQ</a></li>
                </ul>
            </div>

            {{-- Service client --}}
            <div class="flex flex-col gap-6">
                <div>
                    <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold mb-3">Service Client</h4>
                    <p class="text-body text-on-surface-variant text-sm mb-1">WhatsApp: +225 07 00 00 00 00</p>
                    <p class="text-body text-on-surface-variant text-sm">contact@blacjoyaux.ci</p>
                </div>
                <div>
                    <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold mb-3">Paiement Sécurisé</h4>
                    <div class="flex gap-3 items-center flex-wrap">
                        <span class="font-sans font-bold italic text-primary text-sm border border-outline-variant px-2 py-0.5">VISA</span>
                        <span class="font-sans text-[10px] font-bold text-primary border border-outline-variant px-2 py-0.5">MASTERCARD</span>
                        <span class="font-sans text-[10px] font-bold text-secondary border border-secondary/50 px-2 py-0.5">WAVE</span>
                        <span class="font-sans text-[10px] font-bold text-primary border border-outline-variant px-2 py-0.5">ORANGE</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop pt-8 border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-caption text-on-surface-variant/60 text-center sm:text-left">
                © {{ date('Y') }} Blac Joyaux. Tous droits réservés.
            </p>
            <div class="flex gap-4">
                <a href="#" aria-label="Instagram" class="text-on-surface-variant hover:text-secondary transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" aria-label="WhatsApp" class="text-on-surface-variant hover:text-secondary transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    {{-- ====================== MOBILE MENU JS ====================== --}}
    <script>
        // Mobile menu
        const menuOpenBtn  = document.getElementById('menu-open-btn');
        const menuCloseBtn = document.getElementById('menu-close-btn');
        const mobileMenu   = document.getElementById('mobile-menu');
        const menuOverlay  = document.getElementById('menu-overlay');

        function openMenu() {
            mobileMenu.classList.remove('hidden-menu');
            mobileMenu.classList.add('open-menu');
            menuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeMenu() {
            mobileMenu.classList.remove('open-menu');
            mobileMenu.classList.add('hidden-menu');
            menuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        menuOpenBtn?.addEventListener('click', openMenu);
        menuCloseBtn?.addEventListener('click', closeMenu);
        menuOverlay?.addEventListener('click', closeMenu);

        // Search bar toggle
        const searchToggleBtn = document.getElementById('search-toggle-btn');
        const searchContainer = document.getElementById('search-container');

        searchToggleBtn?.addEventListener('click', () => {
            const isOpen = !searchContainer.classList.contains('translate-x-full');
            if (isOpen) {
                searchContainer.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            } else {
                searchContainer.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
                searchContainer.querySelector('input')?.focus();
            }
        });

        // Close search on click outside
        document.addEventListener('click', (e) => {
            if (!searchContainer.contains(e.target) && e.target !== searchToggleBtn) {
                searchContainer.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            }
        });

        // Header scroll shrink
        const header = document.getElementById('main-header');

        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    </script>

    @stack('scripts')
</body>
</html>
