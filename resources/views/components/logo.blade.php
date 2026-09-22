@props(['size' => 'md', 'tone' => 'pink'])

@php
    $sizes = [
        'sm' => ['script' => 'text-xl', 'caption' => 'text-[9px]', 'heart' => 'h-4 w-4'],
        'md' => ['script' => 'text-2xl', 'caption' => 'text-[10px]', 'heart' => 'h-5 w-5'],
        'lg' => ['script' => 'text-4xl', 'caption' => 'text-xs', 'heart' => 'h-7 w-7'],
    ];
    $size = $sizes[$size] ?? $sizes['md'];
    $tones = [
        'pink' => ['script' => 'text-belia-600', 'caption' => 'text-belia-500', 'heart' => 'text-belia-500'],
        'white' => ['script' => 'text-white', 'caption' => 'text-white/80', 'heart' => 'text-white'],
        'plum' => ['script' => 'text-admin-700', 'caption' => 'text-admin-500', 'heart' => 'text-admin-500'],
    ];
    $tone = $tones[$tone] ?? $tones['pink'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex flex-col leading-none']) }}>
    <span class="flex items-end gap-1">
        <svg class="{{ $size['heart'] }} {{ $tone['heart'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 21s-7-4.6-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 11c0 5.4-7 10-7 10Z" />
        </svg>
        <span class="font-script {{ $size['script'] }} {{ $tone['script'] }}">Belia</span>
    </span>
    <span class="ml-5 mt-0.5 {{ $size['caption'] }} font-medium uppercase tracking-[0.4em] {{ $tone['caption'] }}">
        Cosmetic
    </span>
</span>
