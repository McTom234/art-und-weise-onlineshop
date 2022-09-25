<?php

namespace App\Models;

use App\Traits\Uuids;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $base64
 * @method static \Database\Factories\ImageFactory factory(...$parameters)
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereBase64($value)
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'base64'
    ];
}
