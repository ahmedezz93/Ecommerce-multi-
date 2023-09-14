<?php

namespace App\View\Components;

use App\Facades\Cart;
use Illuminate\View\Component;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $carts;

    public function __construct( Cart $carts)
    {
        $this->carts=Cart::get();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
