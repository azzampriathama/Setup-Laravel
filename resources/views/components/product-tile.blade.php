@props(['product'])

<article
    {{ $attributes->merge(['class' => 'flex flex-col overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black/5']) }}>
    <div class="relative">
        <x-product-visual :product="$product" class="aspect-[16/9] w-full" rounded="rounded-none" icon-class="h-20 w-20" />

        @if ($product->badge)
            <span
                class="absolute left-3 top-3 rounded-full bg-belia-500/90 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-white">
                {{ $product->badge }}
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col justify-between gap-3 p-4">
        <div>
            <h3 class="text-sm font-medium text-slate-800">{{ $product->name }}</h3>
            <p class="mt-1 text-sm text-slate-600">{{ rupiah($product->price) }}</p>
        </div>

        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex justify-end">
            @csrf
            <button type="submit" title="Masukkan keranjang"
                class="rounded-md bg-belia-500 p-2 text-white transition hover:bg-belia-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6h15l-1.5 9h-12z" />
                    <path d="M6 6 5 3H2" />
                    <circle cx="9" cy="20" r="1.5" />
                    <circle cx="18" cy="20" r="1.5" />
                </svg>
                <span class="sr-only">Masukkan keranjang</span>
            </button>
        </form>
    </div>
</article>
