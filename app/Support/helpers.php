<?php

use App\Support\Catalog;

if (! function_exists('rupiah')) {
    function rupiah(int|float|null $value, string $prefix = 'Rp. '): string
    {
        return $prefix.number_format((float) ($value ?? 0), 0, ',', '.');
    }
}

if (! function_exists('catalog')) {
    function catalog(): string
    {
        return Catalog::class;
    }
}
