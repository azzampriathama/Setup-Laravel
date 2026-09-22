@props(['product'])

<article
    {{ $attributes->merge(['class' => 'w-[212px] shrink-0 snap-start overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-black/5']) }}>
    <x-product-visual :product="$product" class="aspect-[4/3] w-full" rounded="rounded-none" icon-class="h-14 w-14" />

    <div class="flex h-[104px] flex-col justify-between p-3">
        <p class="line-clamp-2 text-sm font-medium leading-snug text-slate-800">{{ $product->name }}</p>

        <form method="POST" action="{{ route('cart.add', $product) }}">
            @csrf
            <button type="submit"
                class="w-full rounded-md bg-belia-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-belia-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-belia-300">
                Masukkan Keranjang
            </button>
        </form>
    </div>
</article>
