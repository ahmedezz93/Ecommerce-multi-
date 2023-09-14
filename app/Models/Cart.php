<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class Cart extends Model
{
    use HasFactory;
    protected $fillable=['cookie_id','user_id','product_id','quantity','options','net_price'];
    public $incrementing=false;


    protected static function booted(){
        static::addGlobalScope('cookie_id',function(Builder $builder){

            $builder->where('cookie_id', Cart::getCookieId());
        });

        static::observe(CartObserver::class);
    }

    public static function getCookieId()
    {

        $cooke_id = Cookie::get('cart_id');
        if (!$cooke_id) {

            $cooke_id = Str::uuid();
            Cookie::queue('cart_id', $cooke_id, 30 * 24 * 60);
        }
        return $cooke_id;
    }


    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }


}
