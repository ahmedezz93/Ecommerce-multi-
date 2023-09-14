<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Interface\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CartController extends Controller
{

protected $cart;

public function __construct(CartRepositoryInterface $cart)
{
      $this->cart=$cart;
}



public function index(){

 return $this->cart->index();

}

public function add(Product $Product){

    return $this->cart->add($Product);

   }


   public function update( $product_id,Request $request){

    return $this->cart->update($product_id,$request);

   }

   public function delete($cart_id){

    return $this->cart->delete($cart_id);

   }

}
