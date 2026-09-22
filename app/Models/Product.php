<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'category',
    'icon',
    'price',
    'badge',
    'description',
    'is_featured',
    'sort_order',
])]
class Product extends Model
{
    use HasFactory;

    /**
     * Daftar kategori beserta label yang tampil di navigasi.
     *
     * @var array<string, string>
     */
    public const CATEGORIES = [
        'skincare' => 'Skincare',
        'makeup' => 'Makeup',
        'bodycare' => 'Bodycare',
        'fragrance' => 'Fragrance',
        'sets' => 'Sets',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'price' => 'integer',
        ];
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
