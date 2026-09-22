@props(['variant' => 'pink', 'title' => ''])

@php
    $isPlum = $variant === 'plum';
    $cardClass = $isPlum
        ? 'bg-admin-700/80 ring-white/20'
        : 'bg-belia-500/70 ring-white/30';
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — Belia Cosmetic</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|great-vibes:400" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="doodle flex min-h-screen items-center justify-center p-5 font-sans antialiased {{ $isPlum ? 'doodle-plum' : 'doodle-pink' }}">
    <div class="w-full max-w-md">
        <div class="rounded-2xl p-8 shadow-2xl ring-1 backdrop-blur-sm {{ $cardClass }}">
            <div class="flex flex-col items-center">
                <x-logo size="lg" tone="white" />
            </div>

            <h1 class="mt-6 text-center text-base font-bold uppercase tracking-wide text-white drop-shadow-sm">
                {{ $title }}
            </h1>

            <div class="mt-6">
                {{ $slot }}
            </div>
        </div>

        <p class="mt-5 text-center text-sm text-white/90">
            <a href="{{ route('home') }}" class="rounded px-2 py-1 hover:underline">&larr; Kembali ke Beranda</a>
        </p>
    </div>
</body>

</html>
