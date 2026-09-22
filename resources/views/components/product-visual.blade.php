@props(['product', 'iconClass' => 'h-16 w-16', 'rounded' => 'rounded-lg'])

@php
    use App\Support\ProductIcon;

    $gradients = [
        'skincare' => 'bg-gradient-to-br from-pink-200 via-rose-100 to-orange-100',
        'makeup' => 'bg-gradient-to-br from-pink-300 via-pink-200 to-fuchsia-200',
        'bodycare' => 'bg-gradient-to-br from-rose-200 via-orange-100 to-amber-100',
        'fragrance' => 'bg-gradient-to-br from-fuchsia-200 via-pink-200 to-purple-200',
        'sets' => 'bg-gradient-to-br from-belia-soft via-pink-100 to-rose-100',
    ];

    $gradient = $gradients[$product->category] ?? $gradients['skincare'];
@endphp

<div {{ $attributes->merge(['class' => "relative flex items-center justify-center overflow-hidden {$rounded} {$gradient}"]) }}>
    <span class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.7),transparent_60%)]"></span>
    <span class="relative text-belia-700/70">
        {!! ProductIcon::svg($product->icon, $iconClass) !!}
    </span>
</div>
