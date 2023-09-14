<?php

namespace App\Repository;

use App\Events\OrderCreated;
use App\Interface\OrderRepositoryInterface;
use App\Models\Cart;
use App\Models\order;
use App\Models\orderAddresses;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderRepository implements OrderRepositoryInterface
{

    public function create()
    {

        $carts=Cart::get();
        return view('site.orders.order',compact('carts'));
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            $carts = Cart::get();

            foreach ($carts as $cart) {

            $order = Order::create([
                'store_id' => $cart->product->store_id,
                'payment_method' => 'cod',
                'user_id' => Auth()->user()->id,
            ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->net_price,
                    'quantity' => $cart->quantity,
                ]);
            }

           orderAddresses::create([

            'order_id' => $order->id,
            'type' => 'shipping',
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'phone_number' => $request->phone,

           ]);


           event(new OrderCreated($order));

            DB::commit();

            return back();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
};
