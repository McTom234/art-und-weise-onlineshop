<?php

namespace App\Models;

use App\Traits\Uuids;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Checkout
 *
 * @property string $id
 * @property string $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CheckoutFactory factory(...$parameters)
 * @method static Builder|Checkout newModelQuery()
 * @method static Builder|Checkout newQuery()
 * @method static Builder|Checkout query()
 * @method static Builder|Checkout whereCreatedAt($value)
 * @method static Builder|Checkout whereId($value)
 * @method static Builder|Checkout whereUpdatedAt($value)
 * @method static Builder|Checkout whereUserId($value)
 * @mixin Eloquent
 */
class Checkout extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
