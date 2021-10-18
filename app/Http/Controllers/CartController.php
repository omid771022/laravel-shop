<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helper\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{  
    public function cart(){
        return  view('cart');

    }

    public function  addToCart(Course $Course)
    {

        if (! Cart::has($Course)) {
            Cart::put(
                [
                    'id' => 1,
                    'quantity' => 100,
                    'price' => $Course->getFinalPrice(),

                ],
                $Course
            );
        }
    
        return back();
    }

    public function delete($course){
        
            Cart::delete($course);
           return back();
    }
    
}
