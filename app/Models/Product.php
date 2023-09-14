<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'slug', 'store_id', 'category_id', 'price', 'compare_price', 'options', 'rating', 'featured', 'description', 'image', 'status'];

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id')->withDefault(['name' => '-']);
    }

    public function store()
    {

        return $this->belongsTo(Store::class, 'store_id');
    }

    public function tags()
    {

        return $this->belongsToMany(tag::class, 'product_tag');
    }


    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {

            return   "https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png";
        }

        return   asset('storage/' . $this->image);
    }

    public function getPercentageDiscountAttribute()
    {

        if ($this->compare_price) {

            return number_format(100 - (($this->price) / ($this->compare_price) * 100));
        }
    }

    public function cart()
    {
        return $this->hasOne(Cart::class,'product_id')->withDefault(['product_id'=>'none']);
    }

}
