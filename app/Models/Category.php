<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const number = '10';
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'image', 'status'];


    public function products()
    {

        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {

        return  $this->belongsTo(Category::class, 'parent_id')->withDefault(['name' => '-']);
    }

    public function childs()
    {

        return $this->hasMany(Category::class, 'parent_id');
    }


    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }
    public function scopeParent(Builder $builder)
    {
        $builder->where('parent_id', Null);
    }


    public function getImageUrlAttribute()
    {
        if (!$this->image) {

            return   "https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png";
        }

        return   asset('storage/' . $this->image);
    }
}
