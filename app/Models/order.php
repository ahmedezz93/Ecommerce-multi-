<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function store()
    {

        return $this->belongsTo(Store::class, 'store_id');
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id')->withDefault(['name' => 'guest Customer']);
    }


    protected static function booted()
    {


        static::creating(function (order $order) {

            $order->number = order::getNextOrderNumber();
        });
    }



    public function products(){


        return $this->belongsToMany(Product::class,'order_items')->withPivot(['product_name','price','quantity']);
    }


    public function billingAddress(){


        return $this->hasOne(orderAddresses::class,'order_id')->where('type','billing');
    }


    public function shippingAddress(){


        return $this->hasOne(orderAddresses::class,'order_id')->where('type','shipping');
    }

    protected static function getNextOrderNumber()
    {


        $year = Carbon::now()->year;
        $number = order::whereYear('created_at', $year)->max('number');

        if ($number) {

            return  $number + 1;
        }
        return $year . '0001';
    }
}
