<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function add(Product $product)
    {


        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        } else {
            $cart = [];
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['count']++;
        } else {
            $cart[$product->id] = array("title" => $product->title, "price" => $product->price, "count" => 1);
        }

        setcookie("cart", json_encode($cart), time() + (24 * 60 * 60), "/");

        return redirect()->intended('/');
    }

    function checkout()
    {
        if (Auth::guest()) {
            return redirect()->intended('/login');
        }
        $total = 0;
        $cart = json_decode($_COOKIE['cart']);
        foreach ($cart as $item) {

            $total += $item->count * $item->price;
        }


        $order = Order::create([
            "user_id" => Auth::user()->id,
            "cart" => $_COOKIE['cart'],
            "amount" => $total

        ]);

        setcookie("cart", "", time() - 100, "/");

        return view("checkout", ["order" => $order]);
    }
}
