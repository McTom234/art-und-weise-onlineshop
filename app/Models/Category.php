<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Uuids;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productsByQuery($query)
    {
        return $this->belongsToMany(Product::class)->where('name', 'LIKE', "%{$query}%")->orWhere('description', 'LIKE', "%{$query}%");
    }

}
