<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Product
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $price
 * @property int $discount
 * @property int $contingent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereContingent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
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
        return number_format($this->getPriceEuro() * $this->discount / 100, 2);
    }

    public function getShortDescription($charsLimit = 150)
    {
        if (strlen($this->description) > $charsLimit)
            return substr($this->description, 0, strrpos(substr($this->description, 0, $charsLimit), " ")).'...';
        else return $this->description;
    }

    static function getPopularProducts(): array
    {
        // todo rewrite from raw to methode select
        $dbRequest = DB::select('SELECT p.id, (SELECT SUM(o.quantity) from orders o where o.product_id = p.id) as count from products p order by count desc, p.created_at limit 3;');
        $result = [];
        foreach ($dbRequest as $item) {
            $result[] = Product::all()->firstWhere('id', $item->id);
        }
        return $result;
    }
}
