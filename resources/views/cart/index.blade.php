@extends('layouts.app')

@section('title', 'Keranjang Belanja — Belia Cosmetic')

@section('content')
    <section class="mx-auto max-w-6xl px-4 pt-8">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}"
                class="rounded-full p-1 text-slate-700 transition hover:bg-slate-100" aria-label="Kembali">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M11 6l-6 6 6 6" />
                </svg>
            </a>
            <h1 class="text-lg font-semibold text-slate-800">Keranjang Belanja</h1>
        </div>

        @if ($items->isEmpty())
            <div class="mt-10 rounded-xl bg-slate-100 px-6 py-16 text-center">
                <p class="text-sm font-medium text-slate-700">Keranjang belanja kamu masih kosong.</p>
                <p class="mt-1 text-xs text-slate-500">Yuk pilih produk kecantikan favoritmu terlebih dahulu.</p>
                <a href="{{ route('home') }}"
                    class="mt-5 inline-flex rounded-full bg-belia-500 px-5 py-2.5 text-xs font-medium text-white transition hover:bg-belia-600">
                    Mulai Belanja
                </a>
            </div>
        @else
            <form method="POST" action="{{ route('cart.checkout') }}" class="mt-6" data-cart
                data-shipping="{{ \App\Support\Cart::SHIPPING_COST }}"
                data-free-min="{{ \App\Support\Cart::FREE_SHIPPING_MINIMUM }}">
                @csrf

                <div class="space-y-4">
                    @foreach ($items as $item)
                        @php($product = $item['product'])
                        <div class="flex flex-wrap items-center gap-4 rounded-lg bg-belia-band p-4"
                            data-cart-row data-subtotal="{{ $item['subtotal'] }}">
                            <input type="checkbox" name="selected[]" value="{{ $product->id }}"
                                data-cart-checkbox @checked(cart()->isSelected($product->id))
                                class="h-5 w-5 shrink-0 cursor-pointer appearance-none rounded border-2 border-white bg-white/60 checked:border-belia-500 checked:bg-belia-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300"
                                aria-label="Pilih {{ $product->name }}">

                            <x-product-visual :product="$product" class="h-20 w-20 shrink-0" icon-class="h-9 w-9" />

                            <div class="min-w-[180px] flex-1">
                                <p class="text-base font-medium text-slate-800">{{ $product->name }}</p>
                                <p class="mt-0.5 text-sm text-slate-600">{{ rupiah($product->price) }}</p>

                                <div class="mt-3 inline-flex items-stretch overflow-hidden rounded border border-white bg-white">
                                    <button type="submit" form="qty-minus-{{ $product->id }}"
                                        class="px-3 py-1.5 text-sm text-slate-700 transition hover:bg-belia-50"
                                        aria-label="Kurangi jumlah">&minus;</button>
                                    <span
                                        class="flex w-12 items-center justify-center border-x border-slate-200 px-2 py-1.5 text-sm text-slate-700">{{ $item['qty'] }}</span>
                                    <button type="submit" form="qty-plus-{{ $product->id }}"
                                        class="px-3 py-1.5 text-sm text-slate-700 transition hover:bg-belia-50"
                                        aria-label="Tambah jumlah">+</button>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-sm font-medium text-slate-800">{{ rupiah($item['subtotal']) }}</p>
                                <button type="submit" form="remove-{{ $product->id }}"
                                    class="mt-2 text-xs text-rose-600 hover:underline">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="mt-4 hidden text-sm text-rose-600" data-cart-warning>Pilih minimal satu produk untuk di-check
                    out.</p>

                {{-- Ringkasan pesanan --}}
                <div class="mt-6 rounded-lg bg-belia-band px-5 py-6">
                    <label class="flex cursor-pointer items-center gap-3 text-sm text-slate-800">
                        <input type="checkbox" data-select-all @checked($allSelected)
                            class="h-6 w-6 cursor-pointer appearance-none rounded border-2 border-white bg-white/60 checked:border-belia-500 checked:bg-belia-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                        Pilih Semua
                    </label>

                    <dl class="mt-5 space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-700">Subtotal</dt>
                            <dd class="font-medium text-slate-800" data-summary="subtotal">{{ rupiah($summary['subtotal']) }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="flex items-center gap-1.5 text-slate-700">
                                Ongkos Kirim
                                <span title="{{ \App\Http\Controllers\CartController::shippingInfo() }}"
                                    class="inline-flex h-4 w-4 cursor-help items-center justify-center rounded-full border border-slate-500 text-[10px] text-slate-600">i</span>
                            </dt>
                            <dd class="font-medium text-slate-800" data-summary="shipping">
                                {{ $summary['shipping'] === 0 ? 'Gratis' : rupiah($summary['shipping']) }}</dd>
                        </div>
                        <div class="flex items-center justify-between pt-1 text-base">
                            <dt class="font-semibold text-slate-800">Total</dt>
                            <dd class="font-semibold text-slate-800" data-summary="total">{{ rupiah($summary['total']) }}
                            </dd>
                        </div>
                    </dl>

                    <button type="submit"
                        class="mt-6 w-full rounded-full bg-belia-500 py-3 text-sm font-semibold text-white shadow transition hover:bg-belia-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                        Check Out
                    </button>
                </div>
            </form>

            {{-- Form bantu untuk tombol +/- dan hapus (dikirim lewat atribut form=) --}}
            @foreach ($items as $item)
                @php($product = $item['product'])
                <form id="qty-minus-{{ $product->id }}" method="POST" action="{{ route('cart.update') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="{{ max(0, $item['qty'] - 1) }}">
                </form>
                <form id="qty-plus-{{ $product->id }}" method="POST" action="{{ route('cart.update') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                </form>
                <form id="remove-{{ $product->id }}" method="POST" action="{{ route('cart.remove') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
            @endforeach

            <form method="POST" action="{{ route('cart.clear') }}" class="mt-4 text-right">
                @csrf
                <button type="submit" class="text-xs text-slate-500 hover:text-rose-600 hover:underline">Kosongkan
                    keranjang</button>
            </form>
        @endif
    </section>
@endsection
