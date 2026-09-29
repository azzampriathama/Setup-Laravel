@extends('layouts.app')

@section('title', 'Dashboard Admin — Belia Cosmetic')

@section('content')
    @php
        $recentOrders = [
            ['invoice' => 'BL-20260928-A1B2C', 'customer' => 'Sari Dewi', 'method' => 'Transfer Bank', 'total' => 350000, 'status' => 'Menunggu Pembayaran'],
            ['invoice' => 'BL-20260927-D4E5F', 'customer' => 'Rina Amelia', 'method' => 'E-Wallet', 'total' => 204000, 'status' => 'Menunggu Pembayaran'],
            ['invoice' => 'BL-20260926-G7H8I', 'customer' => 'Dewi Lestari', 'method' => 'COD', 'total' => 129000, 'status' => 'Menunggu Pembayaran'],
        ];
    @endphp

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

        <div class="mt-8 overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black/5">
            <div class="border-b border-slate-100 px-5 py-4">
                <h2 class="text-base font-semibold text-slate-800">Pesanan Terbaru</h2>
            </div>

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
                        @foreach ($recentOrders as $order)
                            <tr class="hover:bg-belia-50/40">
                                <td class="px-5 py-3 font-medium text-slate-800">{{ $order['invoice'] }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $order['customer'] }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $order['method'] }}</td>
                                <td class="px-5 py-3 text-slate-700">{{ rupiah($order['total']) }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-medium text-amber-700">{{ $order['status'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
