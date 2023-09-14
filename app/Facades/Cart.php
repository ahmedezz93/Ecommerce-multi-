<?php
namespace App\Facades;
use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Facade;


class Cart extends Facade{


    protected static function getFacadeAccessor()
    {


      return   ModelsCart::class;

    }


}
?>
