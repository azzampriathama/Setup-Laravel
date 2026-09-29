@extends('layouts.app')

@section('title', 'Keranjang Belanja — Belia Cosmetic')

@section('content')
    @php
        $items = [
            ['name' => 'Toner Pad Skintific', 'category' => 'skincare', 'icon' => 'pad', 'price' => 129000, 'qty' => 1],
            ['name' => 'Rhode Lip Serum', 'category' => 'makeup', 'icon' => 'lipstick', 'price' => 75000, 'qty' => 2],
        ];
        $subtotal = collect($items)->sum(fn (array $item) => $item['price'] * $item['qty']);
    @endphp

    <section class="mx-auto max-w-6xl px-4 pt-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}"
                class="rounded-full p-1 text-slate-700 transition hover:bg-slate-100" aria-label="Kembali">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M11 6l-6 6 6 6" />
                </svg>
            </a>
            <h1 class="text-lg font-semibold text-slate-800">Keranjang Belanja</h1>
        </div>

        <div class="mt-6 space-y-4">
            @foreach ($items as $item)
                <div class="flex flex-wrap items-center gap-4 rounded-lg bg-belia-band p-4">
                    <input type="checkbox" checked
                        class="h-5 w-5 shrink-0 cursor-pointer appearance-none rounded border-2 border-white bg-white/60 checked:border-belia-500 checked:bg-belia-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300"
                        aria-label="Pilih {{ $item['name'] }}">

                    <x-product-visual :product="$item" class="h-20 w-20 shrink-0" icon-class="h-9 w-9" />

                    <div class="min-w-[180px] flex-1">
                        <p class="text-base font-medium text-slate-800">{{ $item['name'] }}</p>
                        <p class="mt-0.5 text-sm text-slate-600">{{ rupiah($item['price']) }}</p>

                        <div class="mt-3 inline-flex items-stretch overflow-hidden rounded border border-white bg-white">
                            <button type="button"
                                class="px-3 py-1.5 text-sm text-slate-700 transition hover:bg-belia-50"
                                aria-label="Kurangi jumlah">&minus;</button>
                            <span
                                class="flex w-12 items-center justify-center border-x border-slate-200 px-2 py-1.5 text-sm text-slate-700">{{ $item['qty'] }}</span>
                            <button type="button"
                                class="px-3 py-1.5 text-sm text-slate-700 transition hover:bg-belia-50"
                                aria-label="Tambah jumlah">+</button>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="text-sm font-medium text-slate-800">{{ rupiah($item['price'] * $item['qty']) }}</p>
                        <button type="button" class="mt-2 text-xs text-rose-600 hover:underline">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 rounded-lg bg-belia-band px-5 py-6">
            <label class="flex cursor-pointer items-center gap-3 text-sm text-slate-800">
                <input type="checkbox" checked
                    class="h-6 w-6 cursor-pointer appearance-none rounded border-2 border-white bg-white/60 checked:border-belia-500 checked:bg-belia-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                Pilih Semua
            </label>

            <dl class="mt-5 space-y-2 text-sm">
                <div class="flex items-center justify-between">
                    <dt class="text-slate-700">Subtotal</dt>
                    <dd class="font-medium text-slate-800">{{ rupiah($subtotal) }}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-slate-700">Ongkos Kirim</dt>
                    <dd class="font-medium text-slate-800">Gratis</dd>
                </div>
                <div class="flex items-center justify-between pt-1 text-base">
                    <dt class="font-semibold text-slate-800">Total</dt>
                    <dd class="font-semibold text-slate-800">{{ rupiah($subtotal) }}</dd>
                </div>
            </dl>

            <a href="{{ route('checkout.index') }}"
                class="mt-6 block w-full rounded-full bg-belia-500 py-3 text-center text-sm font-semibold text-white shadow transition hover:bg-belia-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                Check Out
            </a>
        </div>
    </section>
@endsection
