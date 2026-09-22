@extends('layouts.app')

@section('title', 'Belia Cosmetic — Your Beauty, Our Priority')

@section('content')
    @php
        $heroThemes = [
            'pink' => 'from-belia-soft via-pink-100 to-orange-100',
            'rose' => 'from-rose-100 via-pink-200 to-rose-50',
            'amber' => 'from-amber-100 via-orange-100 to-pink-100',
            'fuchsia' => 'from-fuchsia-100 via-pink-200 to-purple-100',
        ];
    @endphp

    {{-- ================= Hero slider ================= --}}
    <section class="mx-auto max-w-6xl px-4 pt-6">
        <div class="relative" data-slider>
            <div class="overflow-hidden rounded-2xl shadow-sm">
                <div class="flex transition-transform duration-500 ease-out" data-slider-track>
                    @foreach ($slides as $slide)
                        <div class="w-full shrink-0">
                            <div
                                class="flex items-center gap-6 bg-gradient-to-r px-6 py-8 sm:px-10 sm:py-10 {{ $heroThemes[$slide['theme']] ?? $heroThemes['pink'] }}">
                                <div class="flex-1">
                                    <p class="font-script text-2xl text-belia-600 sm:text-3xl">{{ $slide['eyebrow'] }}</p>
                                    <p class="mt-1 text-lg font-bold uppercase tracking-wide text-slate-800 sm:text-xl">
                                        {{ $slide['title'] }}
                                    </p>
                                    <p class="mt-2 max-w-sm text-xs leading-relaxed text-slate-600 sm:text-sm">
                                        {{ $slide['text'] }}
                                    </p>
                                    <a href="{{ route('products.category', $slide['category']) }}"
                                        class="mt-5 inline-flex items-center gap-2 rounded-full bg-belia-500 px-5 py-2.5 text-xs font-medium text-white shadow transition hover:bg-belia-600">
                                        {{ $slide['cta'] }}
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14M13 6l6 6-6 6" />
                                        </svg>
                                    </a>
                                </div>

                                <div class="hidden items-end gap-3 text-belia-700/60 sm:flex">
                                    @foreach (['spray', 'bottle', 'jar'] as $heroIcon)
                                        <span
                                            class="flex h-32 w-24 items-center justify-center rounded-xl bg-white/50 ring-1 ring-white/70">
                                            {!! \App\Support\ProductIcon::svg($heroIcon, 'h-14 w-14') !!}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="button" data-slider-prev aria-label="Banner sebelumnya"
                class="absolute left-2 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-belia-600 shadow ring-1 ring-belia-100 transition hover:bg-white">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 6l-6 6 6 6" />
                </svg>
            </button>
            <button type="button" data-slider-next aria-label="Banner selanjutnya"
                class="absolute right-2 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-belia-600 shadow ring-1 ring-belia-100 transition hover:bg-white">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 6l6 6-6 6" />
                </svg>
            </button>

            <div class="absolute bottom-3 left-1/2 flex -translate-x-1/2 gap-1.5" data-slider-dots></div>
        </div>
    </section>

    {{-- ================= Shop All ================= --}}
    <section class="mt-10 bg-slate-100 py-8">
        <div class="mx-auto max-w-6xl px-4">
            <h2 class="text-lg font-semibold text-slate-800">Shop All</h2>

            <div class="relative mt-4">
                <button type="button" data-carousel-prev="#shop-all"
                    class="absolute -left-3 top-1/2 z-10 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white text-belia-600 shadow ring-1 ring-belia-100 transition hover:bg-belia-50"
                    aria-label="Geser ke kiri">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 6l-6 6 6 6" />
                    </svg>
                </button>

                <div id="shop-all"
                    class="scrollbar-none flex snap-x gap-4 overflow-x-auto scroll-smooth pb-1">
                    @foreach ($shopAll as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <button type="button" data-carousel-next="#shop-all"
                    class="absolute -right-3 top-1/2 z-10 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white text-belia-600 shadow ring-1 ring-belia-100 transition hover:bg-belia-50"
                    aria-label="Geser ke kanan">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 6l6 6-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    {{-- ================= New Arrival ================= --}}
    <section class="mx-auto mt-10 max-w-6xl px-4">
        <div class="grid gap-5 sm:grid-cols-2">
            @forelse ($newArrivals as $product)
                <article class="flex items-center gap-4 overflow-hidden rounded-xl bg-belia-soft p-5">
                    <div class="flex-1">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-belia-600">
                            {{ $product->badge ?? 'New Arrival' }}
                        </p>
                        <h3 class="mt-1 text-sm font-bold uppercase tracking-wide text-slate-800">{{ $product->name }}
                        </h3>
                        <p class="mt-1 text-xs text-slate-600">{{ rupiah($product->price) }}</p>
                        <a href="{{ route('products.category', $product->category) }}"
                            class="mt-4 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-[11px] font-medium text-belia-700 shadow-sm transition hover:bg-belia-50">
                            Belanja Sekarang
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </a>
                    </div>

                    <x-product-visual :product="$product" class="h-28 w-28 shrink-0" icon-class="h-14 w-14" />
                </article>
            @empty
                <p class="text-sm text-slate-500">Belum ada produk promo.</p>
            @endforelse
        </div>
    </section>
@endsection
