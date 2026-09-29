@extends('layouts.app')

@section('title', 'Metode Pembayaran — Belia Cosmetic')

@section('content')
    @php
        $methods = [
            'transfer' => ['label' => 'Transfer Bank', 'description' => 'BCA, BNI, BRI, Mandiri', 'icon' => 'bank'],
            'ewallet' => ['label' => 'E-Wallet', 'description' => 'DANA, OVO, GoPay, ShopeePay', 'icon' => 'wallet'],
            'cod' => ['label' => 'COD (Bayar di tempat)', 'description' => 'Tersedia untuk area tertentu', 'icon' => 'cash'],
        ];
        $items = [
            ['name' => 'Toner Pad Skintific', 'qty' => 1, 'subtotal' => 129000],
            ['name' => 'Rhode Lip Serum', 'qty' => 2, 'subtotal' => 150000],
        ];
        $subtotal = collect($items)->sum('subtotal');
    @endphp

    <section class="mx-auto max-w-3xl px-4 pt-8">
        <h1 class="text-lg font-semibold text-slate-800">Metode Pembayaran</h1>

        <div class="mt-6 space-y-6">
            <div class="space-y-4">
                @foreach ($methods as $key => $method)
                    <label
                        class="flex cursor-pointer items-center gap-4 rounded-lg bg-belia-band p-4 ring-belia-400 transition has-[:checked]:ring-2">
                        <input type="radio" name="payment_method" value="{{ $key }}" class="peer sr-only"
                            @checked($loop->first)>

                        <span class="flex h-12 w-12 shrink-0 items-center justify-center text-slate-900">
                            @switch($method['icon'])
                                @case('bank')
                                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3l9 5H3l9-5Z" />
                                        <path d="M5 10v7M10 10v7M14 10v7M19 10v7" />
                                        <path d="M3 20h18M4 17h16" />
                                    </svg>
                                @break

                                @case('wallet')
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-500">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="white"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 13c3-3 6 3 9 0s6 3 11-1" />
                                        </svg>
                                    </span>
                                @break

                                @default
                                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="11" rx="1.5" />
                                        <circle cx="12" cy="12.5" r="2.6" />
                                        <path d="M5.5 7V5h13v2" />
                                    </svg>
                            @endswitch
                        </span>

                        <span class="flex-1">
                            <span class="block text-base font-medium text-slate-800">{{ $method['label'] }}</span>
                            <span class="mt-0.5 block text-sm text-belia-700/80">{{ $method['description'] }}</span>
                        </span>

                        <span class="peer-checked:hidden">
                            <svg class="h-6 w-6 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="12" cy="12" r="9" />
                            </svg>
                        </span>
                        <span class="hidden peer-checked:inline-flex text-slate-900">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M8 12.5l2.5 2.5L16 9.5" />
                            </svg>
                        </span>
                    </label>
                @endforeach
            </div>

            <div class="rounded-lg bg-belia-band px-5 py-6">
                <h2 class="text-base font-semibold text-slate-800">Data Penerima</h2>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="customer_name" class="text-xs font-medium text-slate-600">Nama Penerima</label>
                        <input id="customer_name" name="customer_name" type="text" value="{{ auth()->user()->name ?? '' }}"
                            placeholder="Nama lengkap"
                            class="mt-1 w-full rounded-md border border-white bg-white px-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-belia-400 focus:outline-none">
                    </div>
                    <div>
                        <label for="customer_phone" class="text-xs font-medium text-slate-600">Nomor HP</label>
                        <input id="customer_phone" name="customer_phone" type="tel" placeholder="08xxxxxxxxxx"
                            class="mt-1 w-full rounded-md border border-white bg-white px-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-belia-400 focus:outline-none">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="customer_address" class="text-xs font-medium text-slate-600">Alamat Lengkap</label>
                    <textarea id="customer_address" name="customer_address" rows="3"
                        placeholder="Jalan, nomor rumah, kelurahan, kecamatan, kota, kode pos"
                        class="mt-1 w-full rounded-md border border-white bg-white px-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-belia-400 focus:outline-none"></textarea>
                </div>
            </div>

            <div class="rounded-lg bg-belia-band px-5 py-6">
                <h2 class="text-base font-semibold text-slate-800">Ringkasan Pesanan</h2>

                <ul class="mt-4 space-y-2 border-b border-belia-200 pb-4 text-sm text-slate-700">
                    @foreach ($items as $item)
                        <li class="flex items-start justify-between gap-4">
                            <span>{{ $item['name'] }}
                                <span class="text-xs text-slate-500">x{{ $item['qty'] }}</span>
                            </span>
                            <span class="shrink-0">{{ rupiah($item['subtotal']) }}</span>
                        </li>
                    @endforeach
                </ul>

                <dl class="mt-4 space-y-2 text-sm">
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
                        <dd class="font-semibold text-belia-700">{{ rupiah($subtotal) }}</dd>
                    </div>
                </dl>
            </div>

            <div class="pt-2 text-center">
                <button type="button"
                    class="w-full max-w-xs rounded-full bg-belia-500 py-3 text-sm font-semibold text-white shadow transition hover:bg-belia-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                    Bayar
                </button>
                <p class="mt-3 text-xs text-slate-500">
                    <a href="{{ route('cart.index') }}" class="hover:underline">&larr; Kembali ke keranjang belanja</a>
                </p>
            </div>
        </div>
    </section>
@endsection
