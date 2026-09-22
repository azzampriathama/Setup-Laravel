@extends('layouts.app')

@php
    $heading = $category
        ? 'Produk '.$categoryLabel
        : ($keyword !== ''
            ? 'Hasil Pencarian "'.$keyword.'"'
            : 'Semua Produk');
@endphp

@section('title', $heading.' — Belia Cosmetic')

@section('content')
    <section class="mx-auto max-w-6xl px-4 pt-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <h1 class="text-lg font-semibold uppercase tracking-wide text-slate-700">{{ $heading }}</h1>

            @if ($products->isNotEmpty())
                <p class="text-xs text-slate-500">{{ $products->count() }} produk ditemukan</p>
            @endif
        </div>

        @if ($category === null && $keyword !== '')
            <div class="mt-4 rounded-lg bg-belia-50 px-4 py-3 text-sm text-belia-800">
                Menampilkan hasil untuk kata kunci <span class="font-semibold">{{ $keyword }}</span>.
                <a href="{{ route('home') }}" class="ml-1 underline">Kembali ke beranda</a>
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="mt-10 rounded-xl bg-slate-100 px-6 py-16 text-center">
                <p class="text-sm font-medium text-slate-700">Produk tidak ditemukan.</p>
                <p class="mt-1 text-xs text-slate-500">Coba gunakan kata kunci lain atau lihat kategori di menu atas.</p>
                <a href="{{ route('home') }}"
                    class="mt-5 inline-flex rounded-full bg-belia-500 px-5 py-2.5 text-xs font-medium text-white transition hover:bg-belia-600">
                    Kembali ke Beranda
                </a>
            </div>
        @else
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-tile :product="$product" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
