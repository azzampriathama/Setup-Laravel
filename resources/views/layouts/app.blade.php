@php
    use App\Models\Product;

    $navCategories = Product::CATEGORIES;
    $activeCategory = request()->routeIs('products.category') ? request()->route('category') : null;
    $cartCount = cart()->count();
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Belia Cosmetic — Glow Ur Way, Everyday')</title>
    <meta name="description" content="Belia Cosmetic menyediakan produk skincare, makeup, bodycare, dan fragrance original.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|great-vibes:400" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-white font-sans text-slate-800 antialiased">
    <header class="sticky top-0 z-40 border-b border-belia-100 bg-white/95 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4">
            {{-- Baris atas: logo, pencarian, ikon --}}
            <div class="flex items-center gap-4 py-3">
                <a href="{{ route('home') }}" class="shrink-0" aria-label="Belia Cosmetic">
                    <x-logo size="md" />
                </a>

                <form action="{{ route('products.search') }}" method="GET" class="relative hidden flex-1 sm:block">
                    <label for="cari" class="sr-only">Cari produk</label>
                    <input id="cari" name="q" type="search" value="{{ request('q') }}" placeholder="Cari Produk.."
                        class="w-full rounded-full border border-belia-200 bg-white py-2 pl-4 pr-11 text-sm text-slate-700 placeholder:text-slate-400 focus:border-belia-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-100">
                    <button type="submit"
                        class="absolute right-1 top-1/2 -translate-y-1/2 rounded-full p-2 text-belia-400 transition hover:text-belia-600"
                        aria-label="Cari">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>
                    </button>
                </form>

                <div class="ml-auto flex items-center gap-3 text-belia-500">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                            @csrf
                            <button type="submit" title="Keluar ({{ auth()->user()->name }})"
                                class="flex items-center rounded-full p-1.5 transition hover:bg-belia-50">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" title="Masuk ke akun Belia"
                            class="rounded-full p-1.5 transition hover:bg-belia-50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                            </svg>
                            <span class="sr-only">Masuk</span>
                        </a>
                    @endauth

                    <a href="{{ route('admin.login') }}" title="Masuk sebagai admin"
                        class="rounded-full p-1.5 transition hover:bg-belia-50">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="8" r="3.5" />
                            <path d="M2 20c0-3.5 3-5 7-5s7 1.5 7 5" />
                            <path d="M17 8h5M19.5 5.5v5" />
                        </svg>
                        <span class="sr-only">Masuk admin</span>
                    </a>

                    <a href="{{ route('cart.index') }}" title="Keranjang belanja"
                        class="relative rounded-full p-1.5 transition hover:bg-belia-50">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-12z" />
                            <path d="M6 6 5 3H2" />
                            <circle cx="9" cy="20" r="1.5" />
                            <circle cx="18" cy="20" r="1.5" />
                        </svg>
                        @if ($cartCount > 0)
                            <span
                                class="absolute -right-0.5 -top-0.5 flex h-4 min-w-4 items-center justify-center rounded-full bg-belia-500 px-1 text-[10px] font-semibold text-white">{{ $cartCount }}</span>
                        @endif
                        <span class="sr-only">Keranjang belanja</span>
                    </a>
                </div>
            </div>

            {{-- Navigasi kategori --}}
            <nav class="flex flex-wrap items-center gap-x-7 gap-y-2 pb-3 text-sm">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'font-semibold text-belia-600' : 'text-slate-700 hover:text-belia-600' }}">Beranda</a>
                @foreach ($navCategories as $key => $label)
                    <a href="{{ route('products.category', $key) }}"
                        class="{{ $activeCategory === $key ? 'font-semibold text-belia-600' : 'text-slate-700 hover:text-belia-600' }}">{{ $label }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @if (session('success') || session('error'))
            <div class="mx-auto max-w-6xl px-4 pt-4">
                @if (session('success'))
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-16">
        <div class="bg-belia-band py-10 text-center">
            <x-logo size="lg" class="items-center" />
            <p class="mt-2 text-sm font-semibold uppercase tracking-[0.35em] text-belia-700">Glow Ur Way, Everyday</p>
        </div>
        <div class="bg-slate-100 py-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Belia Cosmetic. Seluruh hak cipta dilindungi.
            <span class="mx-1">•</span>
            <a href="{{ route('admin.login') }}" class="text-belia-600 hover:underline">Login Admin</a>
        </div>
    </footer>
</body>

</html>
