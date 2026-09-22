@extends('layouts.app')

@section('title', 'Pesanan '.$order->invoice_number.' — Belia Cosmetic')

@section('content')
    <section class="mx-auto max-w-2xl px-4 pt-10">
        <div class="rounded-2xl bg-belia-band px-6 py-8 text-center">
            <span class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-belia-500 text-white">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7" />
                </svg>
            </span>
            <h1 class="mt-4 text-lg font-semibold text-slate-800">Pesanan Berhasil Dibuat</h1>
            <p class="mt-1 text-sm text-slate-600">Terima kasih sudah berbelanja di Belia Cosmetic.</p>
            <p class="mt-3 text-sm text-slate-700">
                No. Invoice: <span class="font-semibold text-belia-700">{{ $order->invoice_number }}</span>
            </p>
        </div>

        <div class="mt-6 rounded-lg bg-white p-6 shadow-sm ring-1 ring-black/5">
            <h2 class="text-base font-semibold text-slate-800">Detail Pesanan</h2>

            <dl class="mt-4 grid gap-3 text-sm sm:grid-cols-2">
                <div>
                    <dt class="text-xs text-slate-500">Nama Penerima</dt>
                    <dd class="text-slate-800">{{ $order->customer_name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500">Nomor HP</dt>
                    <dd class="text-slate-800">{{ $order->customer_phone }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs text-slate-500">Alamat Pengiriman</dt>
                    <dd class="text-slate-800">{{ $order->customer_address }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500">Metode Pembayaran</dt>
                    <dd class="text-slate-800">{{ $order->payment_label }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500">Status</dt>
                    <dd class="text-belia-700">{{ $order->status }}</dd>
                </div>
            </dl>

            <ul class="mt-6 space-y-2 border-t border-slate-100 pt-4 text-sm">
                @foreach ($order->items as $item)
                    <li class="flex items-start justify-between gap-4 text-slate-700">
                        <span>{{ $item->product_name }} <span class="text-xs text-slate-500">x{{ $item->qty }}</span></span>
                        <span>{{ rupiah($item->subtotal) }}</span>
                    </li>
                @endforeach
            </ul>

            <dl class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-sm">
                <div class="flex justify-between">
                    <dt class="text-slate-600">Subtotal</dt>
                    <dd class="text-slate-800">{{ rupiah($order->subtotal) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-600">Ongkos Kirim</dt>
                    <dd class="text-slate-800">
                        {{ $order->shipping_cost === 0 ? 'Gratis' : rupiah($order->shipping_cost) }}</dd>
                </div>
                <div class="flex justify-between text-base">
                    <dt class="font-semibold text-slate-800">Total</dt>
                    <dd class="font-semibold text-belia-700">{{ rupiah($order->total) }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('home') }}"
                class="rounded-full bg-belia-500 px-6 py-2.5 text-xs font-medium text-white transition hover:bg-belia-600">
                Lanjut Belanja
            </a>
            <a href="{{ route('cart.index') }}"
                class="rounded-full bg-white px-6 py-2.5 text-xs font-medium text-belia-700 ring-1 ring-belia-200 transition hover:bg-belia-50">
                Lihat Keranjang
            </a>
        </div>
    </section>
@endsection
