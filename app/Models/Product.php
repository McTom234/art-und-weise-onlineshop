<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, Uuids;

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function getPriceEuro()
    {
        return number_format($this->price / 100, 2);
    }

    public function getDiscountPriceEuro()
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

    static function getPopularProducts()
    {
        // todo rewrite from raw to methode select
        $dbRequest = DB::select('SELECT p.id, (SELECT SUM(o.quantity) from orders o where o.product_id = p.id) as count from products p order by count desc, p.created_at limit 3;');
        $result = [];
        foreach ($dbRequest as $item) {
            $result[] = Product::all()->where('id', $item->id)->first();
        }
        return $result;
    }
}
