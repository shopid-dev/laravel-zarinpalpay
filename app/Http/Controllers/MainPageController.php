<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
   function index(Request $request)
   {
      $prods = Product::latest()->paginate(10, ['*'], 'page', $request->page);


      if (isset($_COOKIE['cart'])) {

         $cart = json_decode($_COOKIE['cart']);

      } else {
         $cart = null;
      }



      return view("index", ["pageTitle"=>"صفه اول","products" => $prods, "cart" => $cart]);
   }
}
