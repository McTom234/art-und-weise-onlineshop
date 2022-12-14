<?php

namespace App\Models;

use App\Traits\Uuids;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Location
 *
 * @property string $id
 * @property string $street
 * @property string $street_number
 * @property int $postcode
 * @property string $city
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\LocationFactory factory(...$parameters)
 * @method static Builder|Location newModelQuery()
 * @method static Builder|Location newQuery()
 * @method static Builder|Location query()
 * @method static Builder|Location whereCity($value)
 * @method static Builder|Location whereCreatedAt($value)
 * @method static Builder|Location whereId($value)
 * @method static Builder|Location wherePostcode($value)
 * @method static Builder|Location whereStreet($value)
 * @method static Builder|Location whereStreetNumber($value)
 * @method static Builder|Location whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Location extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'street',
        'street_number',
        'postcode',
        'city'
    ];
}
