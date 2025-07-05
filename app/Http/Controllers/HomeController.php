<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function login_home()
    {
        if (Auth::id()) {
            $products = Product::all(); // Get all products from the database
            $user = Auth::user(); // Get the currently authenticated user
            $userid =  $user->id; // Get the ID of the authenticated user
            $count = Cart::where('user_id', $userid)->count(); // Count the number of cart items for this user

        }else{
            $products = Product::all(); // Get all products from the database
            $count = 0; // If not authenticated, set count to 0
        }

        return view('home.index', compact('products', 'count'));
    }

    public function home()
    {
       if (Auth::id()) {
            $products = Product::all(); // Get all products from the database
            $user = Auth::user(); // Get the currently authenticated user
            $userid =  $user->id; // Get the ID of the authenticated user
            $count = Cart::where('user_id', $userid)->count(); // Count the number of cart items for this user

        }else{
            $products = Product::all(); // Get all products from the database
            $count = 0; // If not authenticated, set count to 0
        }
        return view('home.index', compact('products'));
    }
}
