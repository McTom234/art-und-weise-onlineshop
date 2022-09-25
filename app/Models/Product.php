<?php

namespace App\Models;

use App\Traits\Uuids;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $price
 * @property int $discount
 * @property int $contingent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product search(string $search)
 * @method static Builder|Product whereContingent($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereDiscount($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'contingent'
    ];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function getPriceEuro(): string
    {
        return number_format($this->price / 100, 2);
    }

    public function getDiscountPriceEuro(): string
    {
        if($this->discount == 0) return  $this->getPriceEuro();
        return number_format($this->getPriceEuro() * (100 - $this->discount) / 100, 2);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%");
    }

    static function getPopularProducts(): Collection
    {
        $popular = Order::groupBy('product_id')->selectRaw('SUM(quantity) as count, product_id')->orderByDesc('count')->limit(3)->pluck('product_id', 'count');
        return Product::all()->filter(fn($product) => $popular->contains($product->id));
    }
}
