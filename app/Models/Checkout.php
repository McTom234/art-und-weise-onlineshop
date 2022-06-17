<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Checkout
 *
 * @property string $id
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checkout whereUserId($value)
 * @mixin \Eloquent
 */
class Checkout extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'user_id'
    ];
}
