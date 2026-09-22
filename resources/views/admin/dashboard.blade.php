@extends('layouts.app')

@section('title', 'Dashboard Admin — Belia Cosmetic')

@section('content')
    <section class="mx-auto max-w-6xl px-4 pt-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-lg font-semibold text-slate-800">Dashboard Admin</h1>
                <p class="text-xs text-slate-500">
                    Masuk sebagai {{ auth()->user()->name }} ({{ auth()->user()->email }})
                </p>
            </div>
            <span
                class="rounded-full bg-admin-700 px-4 py-1.5 text-xs font-medium text-white">Administrator</span>
        </div>

        {{-- Statistik --}}
        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-lg bg-belia-band p-5">
                <p class="text-xs uppercase tracking-wide text-slate-600">Total Produk</p>
                <p class="mt-1 text-2xl font-semibold text-belia-700">{{ $totalProducts }}</p>
            </div>
            <div class="rounded-lg bg-belia-band p-5">
                <p class="text-xs uppercase tracking-wide text-slate-600">Total Pesanan</p>
                <p class="mt-1 text-2xl font-semibold text-belia-700">{{ $totalOrders }}</p>
            </div>
            <div class="rounded-lg bg-belia-band p-5">
                <p class="text-xs uppercase tracking-wide text-slate-600">Total Penjualan</p>
                <p class="mt-1 text-2xl font-semibold text-belia-700">{{ rupiah($totalRevenue) }}</p>
            </div>
        </div>

        {{-- Daftar produk --}}
        <div class="mt-8 overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black/5">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                <h2 class="text-base font-semibold text-slate-800">Daftar Produk</h2>
                <p class="text-xs text-slate-500">Data diambil dari tabel <code>products</code></p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Produk</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3">Harga</th>
                            <th class="px-5 py-3">Badge</th>
                            <th class="px-5 py-3">Shop All</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($products as $product)
                            <tr class="hover:bg-belia-50/40">
                                <td class="flex items-center gap-3 px-5 py-3">
                                    <x-product-visual :product="$product" class="h-10 w-14 shrink-0"
                                        icon-class="h-6 w-6" />
                                    <span class="font-medium text-slate-800">{{ $product->name }}</span>
                                </td>
                                <td class="px-5 py-3 text-slate-600">{{ $categoryCounts[$product->category] ?? $product->category }}</td>
                                <td class="px-5 py-3 text-slate-700">{{ rupiah($product->price) }}</td>
                                <td class="px-5 py-3 text-slate-500">{{ $product->badge ?? '—' }}</td>
                                <td class="px-5 py-3">
                                    @if ($product->is_featured)
                                        <span class="rounded-full bg-belia-100 px-2.5 py-1 text-[11px] font-medium text-belia-700">Tampil</span>
                                    @else
                                        <span class="text-xs text-slate-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pesanan terbaru --}}
        <div class="mt-8 overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black/5">
            <div class="border-b border-slate-100 px-5 py-4">
                <h2 class="text-base font-semibold text-slate-800">Pesanan Terbaru</h2>
            </div>

            @if ($orders->isEmpty())
                <p class="px-5 py-6 text-sm text-slate-500">Belum ada pesanan yang masuk.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-5 py-3">Invoice</th>
                                <th class="px-5 py-3">Pemesan</th>
                                <th class="px-5 py-3">Metode</th>
                                <th class="px-5 py-3">Total</th>
                                <th class="px-5 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-belia-50/40">
                                    <td class="px-5 py-3 font-medium text-slate-800">{{ $order->invoice_number }}</td>
                                    <td class="px-5 py-3 text-slate-600">{{ $order->customer_name }}</td>
                                    <td class="px-5 py-3 text-slate-600">{{ $order->payment_label }}</td>
                                    <td class="px-5 py-3 text-slate-700">{{ rupiah($order->total) }}</td>
                                    <td class="px-5 py-3">
                                        <span class="rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-medium text-amber-700">{{ $order->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-8 flex gap-3">
            <a href="{{ route('home') }}"
                class="rounded-full bg-belia-500 px-6 py-2.5 text-xs font-medium text-white transition hover:bg-belia-600">
                Lihat Toko
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-full bg-white px-6 py-2.5 text-xs font-medium text-belia-700 ring-1 ring-belia-200 transition hover:bg-belia-50">
                    Keluar
                </button>
            </form>
        </div>
    </section>
@endsection
