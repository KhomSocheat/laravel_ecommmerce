<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use Dotenv\Util\Str;
 use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();

        return view('admin.category',compact('data'));
    }
    public function store_category(Request $request){

        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Category added successfully!');
        return redirect()->back();
    }
    public function delete_category(String $id){
        $category = Category::find($id);
        if($category){
            $category->delete();
            toastr()->closeButton()->timeOut(5000)->addSuccess('Category deleted successfully!');
        } else {
            toastr()->closeButton()->timeOut(5000)->addError('Category not found!');
        }
        return redirect()->back();
    }
    public function edit_category(String $id){
        $category = Category::find($id);
         $data = Category::all();
        return view('admin.edit_category',compact('category','data'));
    }
    public function update_category(Request $request, String $id){
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        $category = Category::find($id);

        if($category){
            $category->category_name = $request->category_name;
            $category->save();
            toastr()->closeButton()->timeOut(5000)->addSuccess('Category updated successfully!');
        } else {
            toastr()->closeButton()->timeOut(5000)->addError('Category not found!');
        }
        return redirect()->route('view_category');
    }

    public function view_orders(){
        $orders = Order::all(); // Assuming you have an Order model to fetch orders
        return view('admin.order', compact('orders'));
    }

    public function on_the_way($id){
        $order = Order::find($id);
        if($order){
            $order->status = 'on the way';
            $order->save();
            toastr()->closeButton()->timeOut(5000)->addSuccess('Order status updated to "on the way"!');
        } else {
            toastr()->closeButton()->timeOut(5000)->addError('Order not found!');
        }
        return redirect()->back();
    }
    public function delivered($id){
        $order = Order::find($id);
        if($order){
            $order->status = 'delivered';
            $order->save();
            toastr()->closeButton()->timeOut(5000)->addSuccess('Order status updated to "delivered"!');
        } else {
            toastr()->closeButton()->timeOut(5000)->addError('Order not found!');
        }
        return redirect()->back();
    }
    public function print_invoice($id){
        //Function to generate PDF invoice for an order
        $order = Order::find($id);
        if(!$order){
            toastr()->closeButton()->timeOut(5000)->addError('Order not found!');
            return redirect()->back();
        }
        $pdf = Pdf::loadView('admin.invoice', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }
 
}
