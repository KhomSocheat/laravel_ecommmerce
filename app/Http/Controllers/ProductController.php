<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Flasher\Laravel\Facade\Flasher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Logic to retrieve and display products with pagination and search functionality
        // Check if a search term is provided
        // If a search term is provided, filter products by title
        // If no search term is provided, retrieve all products
        // Return the view with the products data
        $search = $request->input('search');
        if ($search) {
            $products = Product::orderBy('id', 'desc')
                ->where('title', 'LIKE', '%' . $search . '%')
                ->paginate(3);
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(3);
        }
        return view('admin.view_product', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        // Logic to retrieve and display products
        return view('admin.add_product', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|integer|min:0',
            'product_description' => 'required|string',
            'category' => 'required|string|exists:categories,category_name',
            'product_image' => 'required|image',
        ]);

        // Image upload
        $imagePath = $request->file('product_image')->store('products', 'public');

        // Save product
        $product = new Product();
        $product->title = $validated['product_name'];
        $product->description = $validated['product_description'];
        $product->image = $imagePath;
        $product->quantity = $validated['product_quantity'];
        $product->price = $validated['product_price'];
        $product->category = $validated['category'];
        $product->save();

        Flasher::addSuccess('Product added successfully!');
        return redirect()->back();
    }
    public function edit($id)
    {
        // Logic to retrieve a specific product for editing
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit_product', compact('product', 'categories'));
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Delete the image file if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        Flasher::addSuccess('Product deleted successfully!');
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        // 1. Validate form inputs
        $validated = $request->validate([
            'product_name'        => 'required|string|max:255',
            'product_price'       => 'required|numeric|min:0',
            'product_quantity'    => 'required|integer|min:0',
            'product_description' => 'required|string',
            'category'            => 'required|string|exists:categories,category_name',
            'product_image'       => 'nullable|image',
        ]);

        // 2. Retrieve product
        $product = Product::findOrFail($id);

        // 3. Assign updated fields
        $product->title       = $validated['product_name'];
        $product->description = $validated['product_description'];
        $product->quantity    = $validated['product_quantity'];
        $product->price       = $validated['product_price'];
        $product->category    = $validated['category'];

        // 4. If there’s a new image, handle swap
        if ($request->hasFile('product_image')) {
            // a) Keep the old path in a variable
            $oldImage = $product->image;

            // b) Store the new file
            $newPath = $request->file('product_image')
                ->store('products', 'public');

            // c) Update the model
            $product->image = $newPath;

            // d) Delete the old file (if it existed)
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        // 5. Persist changes
        $product->save();

        // 6. Flash & redirect
        Flasher::addSuccess('Product updated successfully!');
        return redirect()->route('show_product');
    }

    public function product_details($id)
    {
        // Logic to retrieve and display product details
        $product = Product::findOrFail($id);

        if (Auth::id()) {
            $products = Product::all(); // Get all products from the database
            $user = Auth::user(); // Get the currently authenticated user
            $userid =  $user->id; // Get the ID of the authenticated user
            $count = Cart::where('user_id', $userid)->count(); // Count the number of cart items for this user

        } else {
            $products = Product::all(); // Get all products from the database
            $count = 0; // If not authenticated, set count to 0
        }
        return view('home.product_details', compact('product', 'count'));
    }

    public function add_cart($id)
    {
        // Logic to add product to cart
        $product_id  = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart();
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        Flasher::addSuccess('Product added to cart successfully!');
        return redirect()->back();
    }
    public function my_cart()
    {

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id; // Get the ID of the authenticated user
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get(); // Get all cart items for this user
        }
        return view('home.my_cart', compact('count', 'cart'));
    }
    public function remove_my_cart(String $id)
    {
        // Logic to remove product from cart
        $cart = Cart::findOrFail($id);
        // Delete the cart item
        $cart->delete();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Product removed successfully!');
        return redirect()->back();
    }
    public function order_confirm(Request $request)
    {
        $name = $request->name;
        $rec_address = $request->rec_address;
        $phone = $request->phone;
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();

        foreach ($cart as $carts) {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $rec_address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $carts->product_id;
            $order->save();
        }
        // Clear the cart after order confirmation
        Cart::where('user_id', $user_id)->delete();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Order placed successfully!');

        
        return redirect()->back();
    }
}
