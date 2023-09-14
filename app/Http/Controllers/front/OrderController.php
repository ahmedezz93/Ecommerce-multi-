<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Interface\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{

protected $order;

public function __construct(OrderRepositoryInterface $order)
{
      $this->order=$order;
}


public function create(){

 return $this->order->create();
}


public function store(Request $request){

    return $this->order->store($request);
   }

}
