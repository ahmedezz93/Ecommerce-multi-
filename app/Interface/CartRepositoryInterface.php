<?php
namespace App\Interface;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

interface CartRepositoryInterface{

public function index();
public function add(Product $Product);
public function update($product_id,$request);
public function delete($cart_id);
public function empty();
public function total();


}
;
