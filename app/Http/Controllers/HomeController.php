<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //count user product order and delivered to display on admin dashboard
        $user = User::where('usertype','user')->get()->count(); // Count the number of users with usertype 'user'
        $products = Product::all()->count(); // Get all products from the database
        $order = Order::all()->count(); // Get all orders from the database
        $delevered = Order::where('status', 'delivered')->count(); // Count the number of delivered orders
        return view('admin.index', compact('user', 'products', 'order', 'delevered'));
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
