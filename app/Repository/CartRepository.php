<?php

namespace App\Repository;

use App\Interface\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{

    public function index()
    {
        $cart = Cart::get();
        return view('site.products.cart', compact('cart'));
    }

    public function add(Product $Product, $quantity = 1)
    {


        $cart = Cart::where('id', $Product->id)->first();
        if ($Product->price) {
            $price = $Product->price;
        } else {
            $price = $Product->compare_price;
        }
        if (!$cart) {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $Product->id,
                'quantity' => $quantity,
                'net_price' => $price,

            ]);

            return back()->with('created', 'created successfully');
        }

        return back();
    }


    public function update($product_id, $request)
    {
        //update quantity of cart

        Cart::where('product_id', $product_id)->update([

            'quantity' => $request->quantity

        ]);

        return back()->with('updated', 'updated successfully');
    }

    public function delete($cart_id)
    {

        Cart::destroy($cart_id);
        return back();
    }

    public function empty()
    {
    }

    public function total()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        $total = 0; // initialize the total to zero

        foreach ($cart as $item) {
            $product_value = $item->product;

            if ($product_value->price) {
                $net = $product_value->price;
            } else {
                $net = $product_value->compare_price;
            }

            $total += $net; // add the item price to the total
        }

        return $total; // return the final total

    }
};
