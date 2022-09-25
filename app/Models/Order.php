<?php

namespace App\Models;

use App\Traits\Uuids;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property string $id
 * @property int $price
 * @property int $discount
 * @property int $quantity
 * @property string $product_id
 * @property string $checkout_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Checkout $checkout
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCheckoutId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDiscount($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order wherePrice($value)
 * @method static Builder|Order whereProductId($value)
 * @method static Builder|Order whereQuantity($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'price',
        'discount',
        'quantity',
        'product_id',
        'checkout_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
}
