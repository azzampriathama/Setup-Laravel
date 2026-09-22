<?php

use App\Support\Cart;

if (! function_exists('rupiah')) {
    /**
     * Format angka menjadi mata uang Rupiah, contoh: Rp. 129.000
     */
    function rupiah(int|float|null $value, string $prefix = 'Rp. '): string
    {
        return $prefix.number_format((float) ($value ?? 0), 0, ',', '.');
    }
}

if (! function_exists('cart')) {
    /**
     * Ambil instance keranjang belanja berbasis session.
     */
    function cart(): Cart
    {
        return app(Cart::class);
    }
}
