<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Member
 *
 * @property string $id
 * @property int $rights
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
 * @mixin \Eloquent
 */
class Member extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'rights',
        'user_id'
    ];
}
